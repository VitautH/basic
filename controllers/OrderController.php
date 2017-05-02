<?php

namespace app\controllers;
use app\controllers\Base\MainController as MainController;
use app\models\User;
use app\models\Order;
use Yii;
use  app;
use yii\web\ForbiddenHttpException;
class OrderController extends MainController
{
    private $user;
    private $order;
private $status;
    public function __construct($id, \yii\base\Module $module, array $config = [])
    {
        $this->user =  new User();
        $this->order= new Order();
        parent::__construct($id, $module, $config);
    }

    /*
     * Access Denided Guest
     */

    public function beforeAction($action)
    {

// ToDo: PHP 7 $this->user::GUEST; !
if ($this->getRole()==User::GUEST) {

    throw new ForbiddenHttpException('Доступ запрещён');
}
else {
    return parent::beforeAction($action);

}
    }

    public function actionCreate()
    {


        $this->order->scenario = 'create_order';
        $request = Yii::$app->request;
        if ($request->isPost) {

            $this->order->load($request->post());

            if ($this->order->save()) {
                return $this->redirect(['order', 'view' => $this->order->id]);

            } else {

                throw new ForbiddenHttpException('Произошла ошибка!');
            }

        }
    }





    //ToDo: вывод списка заказов для менеджера
    public function actionIndex()
    {

        //return $this->render('index');
    }

    // ToDo: переписать!
public function actionView($id){
    return $this->render('view', [
        'model' => $this->findModel($id),
    ]);

}
public function actionPayment()
{
    $request= Yii::$app->request;
    if ($request->isPost) {
if ($request->post()['status']== 1){
    return $this->render('succes', [
        //'model' => $this->findModel($id),
    ]);
}

    }
    else {
        throw new ForbiddenHttpException('Произошла ошибка!');
    }

}

    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new ForbiddenHttpException('The requested page does not exist.');
        }
    }

}
