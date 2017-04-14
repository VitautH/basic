<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "modules_slaidshow".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $img_url
 * @property string $url
 * @property integer $block
 */
class Slaidshow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modules_slaidshow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'img_url', 'url', 'block'], 'required'],
            [['block'], 'integer'],
            [['title', 'content', 'img_url', 'url'], 'string', 'max' => 225],
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
            'content' => 'Content',
            'img_url' => 'Img Url',
            'url' => 'Url',
            'block' => 'Block',
        ];
    }
}
