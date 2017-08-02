<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "coupon".
 *
 * @property integer $id
 * @property integer $coupon
 * @property integer $order_id
 *@property integer $status
 * @property Order $order
 */
class Coupon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coupon', 'order_id'], 'required'],
            [['coupon', 'order_id'], 'integer'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coupon' => 'Coupon',
            'order_id' => 'Order ID',
            'status'=> 'Статус купона',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
