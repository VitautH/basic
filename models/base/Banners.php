<?php


namespace app\models\base;

use Yii;

/**
 * This is the model class for table "modules_banner".
 *
 * @property integer $id
 * @property string $title
 * @property integer $img_url
 */
class Banners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modules_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'img_url'], 'required'],
            [['title'], 'string', 'max' => 225],
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
            'img_url' => 'Img Url',
        ];
    }
}
