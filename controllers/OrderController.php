<?php

namespace app\controllers;
use app\controllers\Base\MainController as MainController;
use app\models\User;
use app\models\Order;
use Yii;
use  app;
use yii\debug\models\timeline\DataProvider;
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
                return $this->redirect(['/order/view', 'id' => $this->order->id]);

            } else {

                throw new ForbiddenHttpException('Доступ запрещён');
            }

        }
    }





    //ToDo: вывод списка заказов для менеджера
    public function actionIndex()
    {
        if ($this->getRole()==User::GUEST or $this->getRole()==User::BUYER  ) {

            throw new ForbiddenHttpException('Доступ запрещён');
        }
        else {
            return $this->render('index');

        }
    }

    // ToDo: переписать!
public function actionView($id){


    return $this->render('view', [
        'model' => $this->findModel($id),
    ]);

}
//ToDo: метод отправки письма

    /**
     * @return string
     * @throws ForbiddenHttpException
     */
    public function actionPayment()
{
    $this->order->scenario = 'payment';
    $request= Yii::$app->request;
    if ($request->isPost) {
        $data = $request->post();
if ($data['status']== 1){
    // @return false | coupon
    $response = $this->order->payment($data);
    if (!$response) {
        throw new ForbiddenHttpException('Произошла ошибка!');

    }
    else {
// ToDo: сделать редирект WebPay API
      //  return $this->redirect(['/order/success', 'id' => $this->order->id]);
        return $this->render('success', [
            'model' =>$response,
        ]);
    }

    }

}


    else
        {
        throw new ForbiddenHttpException('Произошла ошибка!');
    }

}

public function actionSuccess(){

}
// ToDo: Проверить
    protected function findModel($id)
    {
        if (($model =  $this->order->findOne($id)) !== null) {
            return $model;
        } else {
            throw new ForbiddenHttpException('The requested page does not exist.');
        }
    }

}
