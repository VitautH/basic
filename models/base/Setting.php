<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $params
 * @property string $value
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['params', 'value'], 'required'],
            [['params'], 'string', 'max' => 100],
            [['value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'params' => 'Params',
            'value' => 'Value',
        ];
    }
}
