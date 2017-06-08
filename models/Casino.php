<?php

namespace app\models;

use Yii;
use  app\models\base\Casino as BaseCasino;
use yii\helpers\ArrayHelper;
use app\core\ImageClass;
use noam148\imagemanager;
use app\models\City;
/**
 * This is the model class for table "casino".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $meta_keywords
 * @property string $meta_description
 * @property integer $city_id
 * @property string $contacts
 * @property string $phone
 * @property integer $logo_id
 * @property string $games
 * @property string $features
 * @property string $entertainment
 * @property string $parking
 * @property string $working_hours
 * @property string $site
 *
 * @property City $city
 * @property Casino $logo
 * @property Casino[] $casinos
 * @property ImgCasino $imgCasino
 * @property Products[] $products
 */
class Casino extends BaseCasino
{
    public $city_name;
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
            [['description'], 'string'],
            [['city_id', 'logo_id'], 'integer'],
            [['title', 'contacts', 'phone'], 'string', 'max' => 225],
            [['meta_keywords', 'meta_description', 'games', 'features', 'entertainment', 'parking', 'working_hours'], 'string', 'max' => 255],
            [['site'], 'string', 'max' => 50],
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
            'title' => 'Название',
            'description' => 'Description',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'city_id' => 'Город',
            'contacts' => 'Адрес',
            'phone' => 'Phone',
            'logo_id' => 'Логотип',
            'games' => 'Игры',
            'features' => 'Особенности',
            'entertainment' => 'Entertainment',
            'parking' => 'Парковка',
            'working_hours' => 'Время работы',
            'site' => 'Сайт',
            'gallery'=> 'Галерея'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
    public  function getCityName(){

        if($this->city_id !== null) {
            $this->city_name = City::find()
                ->where([ '=', 'id', $this->city_id ])
                ->one();



            return $this->city_name['name'];
        }
        else {
            return "N/A";
        }

    }
    public function getCityList()
    {
        $items_city = City::find()
            ->asArray()
            ->all();
        return  ArrayHelper::map($items_city,'id','name');

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['casino_id' => 'id']);
    }
}
