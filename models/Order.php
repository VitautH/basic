<?php

namespace app\models;
use  app\models\base\Order as BaseOrder;
use Yii;
use app\models\User;
use app\models\Products;

class Order extends BaseOrder
{

    public function rules()
    {
        return [
            [['user_id', 'coupon_id', 'transaction_id'], 'integer'],
            [['paid'], 'boolean'],
            [['product_id', 'amount', 'coupon_id', 'user_id', 'transaction_id', 'paid'], 'required'],
            [['amount'], 'number'],
            [['created_at'], 'safe'], //datetime
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function scenarios()
 {
   $scenarios = parent::scenarios();
     $scenarios['create_order'] = ['user_id','amount', 'created_at', 'product_id', 'paid'];//Scenario Values Only Accepted
     // ToDo: Дополнительные поля Завершения оплаты
     $scenarios['paid'] = ['amount', 'transaction_id', 'user_id', 'paid'];//Scenario Values Only Accepted
        return $scenarios;

 }



    public function load($data, $formName = null)
    {


$this->create_order($data);

        return parent::load($data, $formName); // TODO: Change the autogenerated stub
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        return parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub
    }

    private function create_order($data){
        $this->user_id = Yii::$app->user->identity->id;
        $this->product_id = $data['Products']['id'];
       $this->amount = $data['Products']['price'];
       $this->paid = false;
       $this->transaction_id= null;
    }
public function viewOrder ($id)
{


   $user_id =  self::findOne($id)->user_id;

//   $user = new User();
//    var_dump($this->hasOne(User::className(), ['id' => $user_id]));
var_dump($this);

    die();

}


}
