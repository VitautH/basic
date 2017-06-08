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
            //ToDo: исправить ошибку валидации даты
            [['title', 'category_id'], 'required'],
            [['brief', 'text'], 'string'],
            [['date_published'], 'safe'],
            [['date_created', 'archive'], 'safe'],
            [['category_id'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['meta_keywords', 'meta_description'], 'string', 'max' => 225]

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'brief' => 'Бриф',
            'text' => 'Содержимое',
            'date_published' => 'Дата публикации',
            'category_id' => 'Категория',
            'date_created' => 'Дата создания',
            'CategoryName' => 'Категория',
            'archive' => 'В архив',
            'img_url' => 'Изображение'
        ];
    }

    public function getCategoriesList()
    {
        $сategories_array = Categories::find()->select(['id', 'title'])->all();
        return $items = ArrayHelper::map($сategories_array, 'id', 'title');
    }

    public function getCategoryName()
    {
        if ($this->category_id !== null) {

            $category_name = Categories::find()->select(['id', 'title'])->where('id' == $this->category_id)->one();


            return $category_name->title;
        } else {
            return "N/A";
        }
    }

    public function saveImage()
    {

        $imgUpload = new ImageClass();
        return $path = $imgUpload->uploadImage(UploadedFile::getInstance($this, 'imageFile'), 'articles/');


    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if (UploadedFile::getInstance($this, 'imageFile') !== null) {

            $img_url_path = $this->saveImage();
            $this->setAttribute('img_url', $img_url_path);
        }
        $this->date_created = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd h:i:s');


        return parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub
    }

}
