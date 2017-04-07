<?php
namespace app\models\base;

use Yii;

use yii\helpers\ArrayHelper;
use app\core\ImageClass;
use yii\web\UploadedFile;

class Ourpartner extends  \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modules_our_partners';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url'], 'string'],
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
            'url' => 'Url'
        ];
    }

}