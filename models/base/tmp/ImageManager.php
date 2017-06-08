<?php

namespace app\models\base\tmp;

use Yii;

/**
 * This is the model class for table "ImageManager".
 *
 * @property string $id
 * @property string $fileName
 * @property string $fileHash
 * @property string $created
 * @property string $modified
 * @property string $createdBy
 * @property string $modifiedBy
 */
class ImageManager extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ImageManager';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fileName', 'fileHash', 'created'], 'required'],
            [['created', 'modified'], 'safe'],
            [['createdBy', 'modifiedBy'], 'integer'],
            [['fileName'], 'string', 'max' => 128],
            [['fileHash'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fileName' => 'File Name',
            'fileHash' => 'File Hash',
            'created' => 'Created',
            'modified' => 'Modified',
            'createdBy' => 'Created By',
            'modifiedBy' => 'Modified By',
        ];
    }
}
