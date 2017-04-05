<?php
namespace app\modules\admin\controllers;

use Yii;
use app\models\OurPartner;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * ProductsController implements the CRUD actions for Products model.
 */
class OurpartnerController extends Controller
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
        $model = new OurPartner();
        $data = $model->viewAll();
        return $this->render('index', [
            'model' => $data
        ]);
    }
    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {


        $model = new OurPartner();
        $data = $model->create();
        return $this->render('create', [
            'model' => $data
        ]);




    }

}