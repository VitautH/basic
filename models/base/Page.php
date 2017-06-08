<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $content
 * @property string $date_created
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'meta_description', 'meta_keywords', 'content'], 'required'],
            [['content'], 'string'],
            [['date_created'], 'safe'],
            [['title', 'meta_description', 'meta_keywords'], 'string', 'max' => 225],
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
            'content' => 'Content',
            'date_created' => 'Date',
        ];
    }
}
