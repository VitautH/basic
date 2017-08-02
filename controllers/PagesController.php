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
