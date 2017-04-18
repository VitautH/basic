<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "coupon".
 *
 * @property integer $id
 * @property integer $coupon
 * @property integer $user_id
 * @property integer $product_id
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
            [['coupon', 'user_id', 'product_id'], 'required'],
            [['coupon', 'user_id', 'product_id'], 'integer'],
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
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
        ];
    }
}
