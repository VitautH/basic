<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $coupon_id
 * @property string $amount
 * @property string $currency
 * @property string $code
 * @property string $created_at
 * @property integer $transaction_id
 * @property integer $paid
 *
 * @property Coupon[] $coupons
 * @property Products $product
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'coupon_id', 'transaction_id', 'paid'], 'integer'],
            [['product_id', 'transaction_id', 'paid'], 'required'],
            [['amount'], 'number'],
            [['created_at'], 'safe'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'coupon_id' => 'Coupon ID',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'transaction_id' => 'Transaction ID',
            'paid' => 'Paid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoupons()
    {
        return $this->hasOne(Coupon::className(), ['id' => 'coupon_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
