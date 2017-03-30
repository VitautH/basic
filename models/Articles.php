<?php

namespace app\models;

use Yii;
use  app\models\base\Articles as BaseArticles;
use yii\helpers\ArrayHelper;
use app\core\ImageClass;
use yii\web\UploadedFile;

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
}
