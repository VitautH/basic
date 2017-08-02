<?php
namespace app\modules\admin\controllers;

use Yii;
use app\models\Modules; // ToDo: Создать модель
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
* ProductsController implements the CRUD actions for Products model.
*/
class ModulesController extends AdminController
{
    public function beforeAction($action)
    {

        if (empty(Yii::$app->user->identity)) {
            return false;
        }
        return parent::beforeAction($action);
    }

    /**
     * @inheritdoc
     */


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        echo "I is Modules";
    }

}