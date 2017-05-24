<?php

namespace app\models;

use app\models\base\Page as BasePage;
use yii\behaviors\SluggableBehavior;
use Yii;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $title
 * @property string $brief
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $content
 * @property string $date_created
 */
class Page extends BasePage
{
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
            ],
        ];
    }
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
            [['date_created', 'brief'], 'safe'],
            [['content'], 'string'],
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
            'title' => 'Заголовок',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'content' => 'Содержимое',
            'date_created' => 'Дата создания',
        ];
    }


    public function save($runValidation = true, $attributeNames = null)
    {
        $this->date_created = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd h:i:s');


        return parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub
    }

}
