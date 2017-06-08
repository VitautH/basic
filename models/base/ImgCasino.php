<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "img_casino".
 *
 * @property integer $id
 * @property integer $casino_id
 * @property string $img_url
 *
 * @property Casino $id0
 */
class ImgCasino extends \yii\db\ActiveRecord
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
            'casino_id' => 'Casino ID',
            'img_url' => 'Img Url'
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
