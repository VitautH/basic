<?php

namespace app\models;

use Yii;
use app\models\base\Categories as BaseCategories;
use yii\helpers\ArrayHelper;
use app\core\ImageClass;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;
use yii\db;
/**
 * This is the model class for table "Categories".
 *
 * @property integer $id
 * @property string $title
 * @property string $meta_keywords
 * @property string $meta_description
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string'],
            [['meta_keywords', 'meta_description'], 'required'],
            [['meta_keywords', 'meta_description'], 'string', 'max' => 255],
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
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
        ];
    }
}
