<?php

namespace app\controllers;
use app\controllers\Base\MainController as MainController;
use app\models\User;
use app\models\Order;
use app\models\Coupon;
use Yii;
use  app;
use yii\web\ForbiddenHttpException;
class OrderController extends MainController
{
    /*
     * Access Denided Guest
     */

    public function beforeAction($action)
    {

        $user = new User;
if ($this->getRole()==$user::GUEST) {

    throw new ForbiddenHttpException('Доступ запрещён');
}
else {
    return parent::beforeAction($action);

}
    }

    public function actionCreate()
    {
$coupon =  new Coupon();
$order = new Order();
       var_dump(Yii::$app->request->post());
        Yii::$app->end();
       // return $this->render('create');
    }

    public function actionIndex()
    {

        //return $this->render('index');
    }

}
