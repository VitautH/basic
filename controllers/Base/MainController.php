<?php


namespace app\controllers\Base;

use app\models\base\Articles;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use  app\models\Slaidshow;
class MainController extends \yii\web\Controller
{


    public $slaidshow;
    public function beforeAction($action)
    {
        $this->slaidshow = Slaidshow::find()->all();
        return parent::beforeAction($action);
    }

}