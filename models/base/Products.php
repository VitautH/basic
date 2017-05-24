<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $title
 * @property string $price
 * @property string $description
 * @property string $cashback
 * @property integer $casino_id
 *
 * @property Casino $casino
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'meta_keywords', 'meta_description', 'description'], 'string'],
            [['price', 'cashback'], 'string'],
            [['casino_id'], 'number'],
            [['casino_id'], 'exist', 'skipOnError' => true, 'targetClass' => Casino::className(), 'targetAttribute' => ['casino_id' => 'id']],
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
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'price' => 'Цена',
            'description' => 'Description',
            'cashback' => 'Cashback',
            'casino_id' => 'Casino ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCasino()
    {
        return $this->hasOne(Casino::className(), ['id' => 'casino_id']);
    }

   public function   getProductsServices(){
       return $this->hasMany(ProductsServices::className(), ['id_product' => 'id']);
   }
}
