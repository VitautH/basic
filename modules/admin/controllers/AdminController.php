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
         *  Вход + проверка прав доступа
         * role_id = 1  - admin
         * role_id = 2 - buyer
         * role_id = 3  - menedger
         *

         */
        $user_role =  Yii::$app->user->identity['role_id'];
        if (empty(Yii::$app->user->identity)) {
            $this->redirect('/login');
            return false;
        } else {
            switch ($user_role) {
                case 1:
                    return parent::beforeAction($action);
                    break;

                case 2:
                    Yii::$app->response->redirect('/account');
                    Yii::$app->end();
                    break;

                case 3:

                    Yii::$app->response->redirect('/manager');
                    Yii::$app->end();
                    break;
            }


        }
    }


}