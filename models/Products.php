<?php

namespace app\models;

use Yii;
use app\models\base\Products as BaseProducts;
use yii\helpers\ArrayHelper;

class Products extends BaseProducts
{

    /*
     * Проверка на ввод данных + обязательные поля
     */
    public function rules()
    {
        return [[['title','cost','casino_id'],'required'],
            [['casino_id', 'cost', 'cashback'],'number'],
           [['title', 'description', 'meta_keywords', 'meta_description'],'safe'],
        ];
    }

    /*
     * @return Array CasinoList
     *
     */
    public function getCasinoList()
    {
 $casino_array = casino::find()->select(['id','title'])->all();
       return $items = ArrayHelper::map($casino_array,'id','title');
    }
}
