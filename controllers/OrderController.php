<?php

namespace app\controllers;

use app\controllers\Base\MainController as MainController;
use app\models\User;
use app\models\Order;
use app\models\Products;
use Yii;
use  app;
use yii\debug\models\timeline\DataProvider;
use yii\web\ForbiddenHttpException;

class OrderController extends MainController
{
    private $user;
    private $order;
    private $status;
    public $slug;


    public function __construct($id, \yii\base\Module $module, array $config = [])
    {
        $this->user = new User();
        $this->order = new Order();
        parent::__construct($id, $module, $config);

        $this->slaidshow = null;
    }

    /*
     * Access Denided Guest
     */

    public function beforeAction($action)
    {
        if ($this->getRole() == User::GUEST) {

            throw new ForbiddenHttpException('Доступ запрещён');
        } else {
            return parent::beforeAction($action);
        }

    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $product_id = $request->post()['Products']['id'];
            $order = new Order();
            $response = $order->createOrder(Products::findOne($product_id));
            if ($response !== false) {
                $this->redirect($response);
            } else {
                throw new ForbiddenHttpException('Произошла ошбка при оплате');
            }
        } else {
            throw new ForbiddenHttpException('Доступ запрещён');
        }
    }


    //ToDo: вывод списка заказов для менеджера В отдельный Контроллер!
    public function actionIndex()
    {
        if ($this->getRole() == User::GUEST or $this->getRole() == User::BUYER) {

            throw new ForbiddenHttpException('Доступ запрещён');
        } else {
            return $this->render('index');

        }
    }

    // ToDo: переписать!
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = $this->order->findOne($id)) !== null) {
            return $model;
        } else {
            throw new ForbiddenHttpException('The requested page does not exist.');
        }
    }

}
