<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "casino".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $meta_keywords
 * @property string $meta_description
 * @property integer $city_id
 * @property string $address_street
 * @property string $phone
 * @property string $img_url
 *
 * @property City $city
 * @property ImgCasino $imgCasino
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
            [['city_id'], 'integer'],
            [['title', 'address_street', 'phone', 'img_url'], 'string', 'max' => 225],
            [['description', 'meta_keywords', 'meta_description'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
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
            'description' => 'Description',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'city_id' => 'City ID',
            'address_street' => 'Address Street',
            'phone' => 'Phone',
            'img_url' => 'Img Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImgCasino()
    {
        return $this->hasOne(ImgCasino::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['casino_id' => 'id']);
    }
}
