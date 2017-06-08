<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "img_product".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $img_url
 *
 * @property Casino $id0
 */
class ImgProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'img_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'img_url'], 'required'],
            [['product_id'], 'integer'],
            [['img_url'], 'string', 'max' => 255],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Бонус-план',
            'img_url' => 'Img Url'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
