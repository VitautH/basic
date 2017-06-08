<?php

namespace app\controllers;

use Yii;
use app\models\Page;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\controllers\Base\MainController as MainController;

/**
 * PagesController implements the CRUD actions for Page model.
 */
class PagesController extends MainController
{
    public $slug;

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
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Page::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

//    /**
//     * Displays a single Page model.
//     * @param integer $id
//     * @return mixed
//     */
//   public function actionView($id)
//   {
//
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//   }
//
//
//
//    /**
//     * Finds the Page model based on its primary key value.
//     * If the model is not found, a 404 HTTP exception will be thrown.
//     * @param integer $id
//     * @return Page the loaded model
//     * @throws NotFoundHttpException if the model cannot be found
//     */
//    protected function findModel($id)
//    {
//
//
//        $model = Page::findOne(['id' => $id]);
//
//        if (!empty($model)) {
//            return $model;
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//       }
//    }
    /**
     * Displays slug pages.
     *
     * @return array
     */


    public function actionView($slug)
    {
        $model = $model = Page::findOne(['slug' => $slug]);
        if (empty($model)) {
            $model = $model = Page::findOne(['id' => $slug]);
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
