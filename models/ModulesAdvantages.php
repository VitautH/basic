<?php

namespace app\models;

use Yii;
use app\models\base\ModulesAdvantages as BaseModulesAdvantages;
/**
 * This is the model class for table "modules_advantages".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 */
class ModulesAdvantages extends BaseModulesAdvantages
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modules_advantages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['title'], 'string', 'max' => 222],
            [['content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'content' => 'Содержимое',
        ];
    }
}
