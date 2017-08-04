<?php

namespace app\models;

use  app\models\base\Order as BaseOrder;
use function Sodium\randombytes_buf;
use Yii;
use app\models\User;
use app\models\Products;
use app\models\Coupon;
use yii\base\Security;
use app;
use app\components\Bepaid;
use yii\httpclient\Client;

class Order extends BaseOrder
{
    const CURRENCY = 'USD';
    public $customersEmail;
    private $security;
    private $code;

    public function __construct(array $config = [])
    {
        $this->security = new Security();
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['user_id', 'coupon_id'], 'integer'],
            [['paid', 'error'], 'boolean'],
            [['product_id', 'amount', 'user_id', 'transaction_id', 'paid'], 'required'],
            [['amount'], 'number'],
            [['created_at', 'currency','transaction_id'], 'safe'], //datetime
            [['code'], 'safe'], //datetime
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create_order'] = ['user_id', 'amount', 'created_at', 'product_id', 'paid', 'currency', 'token'];
        $scenarios['payment'] = ['transaction_id', 'paid'];
        $scenarios['rollback'] = ['error'];

        return $scenarios;
    }


    public function createOrder(Products $products)
    {
        $model = new Order();
        $model->setScenario('create_order');
        $model->product_id = $products->id;
        $model->amount = $products->price;
        $model->currency = self::CURRENCY;
        $model->title = 'Order: Bonus plan "' . $products->title . '"';
        $model->user_id = Yii::$app->user->identity->id;
        $model->customersEmail = Yii::$app->user->identity->email;
        $model->paid = false;
        $model->transaction_id = null;
        $model->customersEmail;
        if ($model->save()) {
            $id = Yii::$app->db->lastInsertID;
            $model->id = $id;
            $pay = Yii::$app->get('bepaid');
            $response = $pay->getToken($model);
            $token = $response->getToken();
            $redirect = $response->getRedirectUrl();
            if ($this->saveToken($model->id, $token)) {
                return $redirect;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function payment($data)
    {
        $token = $data['additional_data']['vendor']['token'];
        $model = Order::findOne(['token' => $token]);
        if (empty($model)) {
            return false;
        }
        else {
            $coupon = new Coupon();
            $response = $coupon->saveCoupon($data['uid']);

            if (!$response) {
                return self::rollback($data);
            }

            else {
                $model->setScenario('payment');
                $model->token = null;
                $model->transaction_id = $data['uid'];
                $model->paid = true;
                $model->coupon_id = $response['id'];
                if ($model->save()) {
                    return array('status'=>Bepaid::STATUS_SUCCESS, 'coupon'=>$response['coupon']);
                } else {
                    Coupon::deleteAll(['id' => $response['id']]);

                    return self::rollback($data);
                }
            }
        }
    }

    /*
     * Откат транзакции
     */
    public static function rollback($data)
    {
        $token = $data['additional_data']['vendor']['token'];

        $model = Order::findOne(['token' => $token]);
        $model->setScenario('rollback');
        $model->token = null;
        $model->transaction_id = $data['uid'];
        $model->paid = true;
        $model->error = true;
        if($model->save()){
            return false;
        }
        else {
            var_dump($model->getErrors());
            die();
        }
    }

    private function saveToken($id, $token)
    {
        $model = Order::findOne($id);
        $model->setScenario('create_order');
        $model->token = $token;
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

}
