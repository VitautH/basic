<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Products;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\controllers;

class AdminController extends Controller
{
    public function beforeAction($action)
    {
/*
 *  Редирект на вход
 */
        if (empty(Yii::$app->user->identity)) {
          $this->redirect('/login');
          return false;
        }
        return parent::beforeAction($action);
    }


}