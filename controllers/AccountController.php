<?php

namespace app\controllers;
use app\controllers\Base\MainController as MainController;
use app\models\Articles;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class AccountController extends MainController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
