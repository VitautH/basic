<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\User;
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
         *
         *

         */
        $user = new User;
        Yii::$app->end();
        if (empty(Yii::$app->user->identity)) {
            $this->redirect('/login');
            return false;
        } else {
            $user_role =  Yii::$app->user->identity->role_id;
            switch ($user_role) {
                case $user::ADMIN:
                    return parent::beforeAction($action);
                    break;

                case $user::BUYER:
                    Yii::$app->response->redirect('/account');
                    Yii::$app->end();
                    break;

                case $user::MANAGER:

                    Yii::$app->response->redirect('/manager');
                    Yii::$app->end();
                    break;
            }


        }
    }


}