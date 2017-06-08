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
class Order extends BaseOrder
{
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
            [['user_id', 'coupon_id', 'transaction_id'], 'integer'],
            [['paid'], 'boolean'],
            [['product_id', 'amount', 'user_id', 'transaction_id', 'paid'], 'required'],
            [['amount'], 'number'],
            [['created_at'], 'safe'], //datetime
            [['code'], 'safe'], //datetime
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create_order'] = ['user_id', 'amount', 'created_at', 'product_id', 'paid'];//Scenario Values Only Accepted
        // ToDo: Дополнительные поля Завершения оплаты
        $scenarios['payment'] = ['transaction_id', 'paid'];//Scenario Values Only Accepted
        return $scenarios;

    }


    public function load($data, $formName = null)
    {

        $this->create_order($data);
        return parent::load($data, $formName); // TODO: Change the autogenerated stub
    }


    private function create_order($data)
    {
        $this->user_id = Yii::$app->user->identity->id;
        $this->product_id = $data['Products']['id'];
        $this->amount = $data['Products']['price'];
        $this->paid = false;
        $this->transaction_id = null;

        if($this->save()) {
            $id = Yii::$app->db->lastInsertID;
            $this->payment($id);
        }
        else {
          return false;
        }
    }

    private function payment($id)
    {
        $this->transaction_id = mt_rand(100, 1000);
        $this->user_id = Yii::$app->user->identity->id;
        $this->paid = 1;
        $this->code = $this->security->generateRandomString(6) . $this->id;
        $this->amount = $this->product->price;
        if (!$this->save()) {
           return false;

        }
        // ToDo: внедрить принцип инверсии зависимостей
        $coupon = new Coupon();
        $response = $coupon->saveCoupon($id);


        if ($response !== false) {
            Order::updateAll(['transaction_id' => $this->transaction_id, 'paid' => true, 'coupon_id' => $response['id']], ['=', 'id', $id]);
        }
        return true;


    }




}
