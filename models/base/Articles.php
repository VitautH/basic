<?php

namespace app\models\base;

use Yii;

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
class Articles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'meta_keywords', 'meta_description'], 'required'],
            [['brief', 'text'], 'string'],
            [['date'], 'safe'],
            [['category_id'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['meta_keywords', 'meta_description'], 'string', 'max' => 225],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'brief' => 'Brief',
            'text' => 'Text',
            'date' => 'Date',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImgContent()
    {
        return $this->hasOne(ImgContent::className(), ['id' => 'id']);
    }
}
