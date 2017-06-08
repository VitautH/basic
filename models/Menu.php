<?php

namespace app\models;

use Yii;
use app\models\base\Menu as BaseMenu;
/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $menu_name
 */
class Menu extends BaseMenu
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_name'], 'required'],
            [['menu_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_name' => 'Menu Name',
        ];
    }
}
