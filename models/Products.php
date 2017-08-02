<?php

namespace app\models;

use Yii;
use app\models\base\Products as BaseProducts;
use yii\helpers\ArrayHelper;
use app\core\ImageClass;
use yii\web\UploadedFile;
use app\models\ProductsServices;
use app\models\Services;
use yii\db\ActiveRecord;
use yii\db;

class Products extends BaseProducts
{
    /*
* @property integer $logo_id
*/
    public $casino_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /*
     * Проверка на ввод данных + обязательные поля
     */
    public function rules()
    {
        return [[['title', 'price', 'casino_id'], 'required'],
            [['casino_id', 'price', 'cashback', 'logo_id'], 'number'],

            [['title', 'description', 'meta_keywords', 'meta_description'], 'safe'],
        ];
    }

    /**
     * Название атрибутов
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',

            'logo_id' => 'Логотип',

            'gallery' => 'Галерея'
        ];
    }

    /*
     * @return array CasinoList
     *
     */
    public function getCasinoList()
    {
        $casino_array = Casino::find()->select(['id', 'title'])->all();
        return $items = ArrayHelper::map($casino_array, 'id', 'title');
    }

    /*
    * @return  string getCasinoName
    */

    public function getCasinoName()
    {
        if ($this->casino_id !== null) {
            $connection = Yii::$app->db;
            $this->casino_name = $connection->createCommand("SELECT id, title FROM casino WHERE id = $this->casino_id")->queryOne();
            unset($connection);

            return $this->casino_name['title'];
        } else {
            return "N/A";
        }
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsServices()
    {
        return $this->hasMany(ProductsServices::className(), ['id_product' => 'id']);
    }

}
