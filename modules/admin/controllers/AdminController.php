<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\controllers;
use app\controllers\Base\MainController as MainController;

class AdminController extends MainController
{
    public function beforeAction($action)
    {
        /*
         *  Вход в админ панель + проверка прав доступа

         */
        $user = new User;
if (parent::getRole() == $user::ADMIN) {
    return parent::beforeAction($action);

} else {
    $this->redirect('/login');
    return false;

}

    }


}