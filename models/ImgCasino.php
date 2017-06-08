<?php

namespace app\models;

use Yii;
use app\models\base\ImgCasino  as BaseImgCasino;
use noam148\imagemanager;
/**
 * This is the model class for table "img_casino".
 *
 * @property integer $id
 * @property integer $casino_id
 * @property string $img_url
 * @property integer $main_image
 *
 * @property Casino $id0
 */
class ImgCasino extends BaseImgCasino
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'img_casino';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['casino_id', 'img_url'], 'required'],
            [['casino_id'], 'integer'],
            [['img_url'], 'string', 'max' => 255],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'casino_id' => 'Название казино',
            'img_url' => 'Изображение'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCasino()
    {
        return $this->hasOne(Casino::className(), ['id' => 'casino_id']);
    }
}
