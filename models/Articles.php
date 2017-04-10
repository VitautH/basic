<?php

namespace app\models;

use Yii;
use  app\models\base\Articles as BaseArticles;
use yii\helpers\ArrayHelper;
use app\core\ImageClass;
use yii\web\UploadedFile;
use app\models\Categories;
/**
 * This is the model class for table "articles".
 *
 * @property integer $id
 * @property string $title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $brief
 * @property string $text
 * @property string $date
 * @property integer $category_id
 *
 * @property Categories $category
 * @property ImgContent $imgContent
 */
class Articles extends BaseArticles
{
    public $imageFile;

    public function rules()
    {
        return [
            [['title','category_id'], 'required'],
            [['brief', 'text'], 'string'],
            [['date'], 'safe'],
            [['category_id'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['meta_keywords', 'meta_description'], 'string', 'max' => 225]

        ];
    }
    public function getCategoriesList()
    {
        $сategories_array = Categories::find()->select(['id','title'])->all();
        return $items = ArrayHelper::map($сategories_array,'id','title');
    }
public  function getCategoryName()
{
    if($this->category_id !== null) {

        $category_name = Categories::find()->select(['id','title'])->where('id'== $this->category_id )->one();


        return $category_name->title;
    }
    else {
        return "N/A";
    }
}

}
