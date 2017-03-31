<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "casino".
 *
 * @property integer $id
 * @property string $title
 * @property integer $city_id
 * @property string $address_street
 * @property string $phone
 *
 * @property Products[] $products
 */
class Casino extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'casino';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'address_street', 'phone'], 'string'],
            [['city_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'city_id' => 'City ID',
            'address_street' => 'Address Street',
            'phone' => 'Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['casino_id' => 'id']);
    }
}