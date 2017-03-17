<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Products;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\controllers;
/**
 * ProductsController implements the CRUD actions for Products model.
 */
class AdminController extends Controller
{
    public function beforeAction($action)
    {

        if (empty(Yii::$app->user->identity)) {
            return false;
        }
        return parent::beforeAction($action);
    }


}