<?php

namespace app\controllers;

use app\models\CheckCoupon;
use app\models\Coupon;
use app\models\Order;
use yii\web\NotFoundHttpException;
use app\models\User;
use yii;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\Json;
use app\controllers\Base\MainController as MainController;

class ManagerController extends MainController
{
    public $slug;
    public $slaidshow;

    public function __construct($id, \yii\base\Module $module, array $config = [])
    {
        $this->slaidshow = null;
        parent::__construct($id, $module, $config);
    }

    public function beforeAction($action)
    {
        $this->slaidshow = null;

        if ((parent::getRole() == User::MANAGER) or (parent::getRole() == User::ADMIN)) {

            return parent::beforeAction($action);

        } else {
            $this->redirect(Yii::$app->homeUrl);
            return false;

        }

    }

    public function actionIndex()
    {
        $message = null;
        $model = new CheckCoupon;
        $model->setScenario(CheckCoupon::SCENARIO_CHECK_COUPON_CODE);

        if (!empty($_POST)) {

            $model->load($_POST);
            if (\Yii::$app->request->isAjax) {
                return  $this->ajaxValidation($model);
            }
           else {
                if ($model->validate()) {
                    //   return $this->actionCheckCoupon($model->code);
                    return $this->redirect('/manager/check-coupon?coupon=' . $model->code);
                }
            }

        }

        return $this->render('index', [
            'username' => $this->user_name,
            'model' => $model
        ]);


    }

    public function actionCheckCoupon($coupon)
    {
        $model = new CheckCoupon();
        if (empty($coupon) && !empty($_POST['CheckCoupon']['coupon'])) {
            $coupon = $_POST['CheckCoupon']['coupon'];


        }
        $model_coupon = Coupon::find()->andWhere(['coupon' => $coupon])->one();
        if (empty($model_coupon)){
            return $this->actionIndex();
        }
        if (empty($model_coupon->sms_code)) {
            $model_coupon->generate_sms_code($coupon);
        }

        $user = $model_coupon->order->user;

        return $this->render('view', [
            'sms_code' => $model_coupon->sms_code,
            'model' => $model,
            'user' => $user,
            'username' => $this->user_name
        ]);

    }

    public function actionCheckSms_code()
    {
        $model = new CheckCoupon();
        if (!empty($_POST)) {
            $model->setScenario(CheckCoupon::SCENARIO_CHECK_SMS_CODE);
            $model->load($_POST);

            if (\Yii::$app->request->isAjax) {
              return  $this->ajaxValidation($model);
            } else {
                if ($model->validate()) {
                    $model->cange_status_coupon();
                   return $this->success_view($model);


                }
            }

        }
        else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
public function success_view($model){
$coupon_id= Coupon::find()->andWhere(['sms_code'=>$model->check_sms_code])->select('id')->one()->id;
$order= Order::find()->andWhere(['coupon_id'=>$coupon_id])->one();
$user = User::findOne($order->user_id);
return $this->render('success',[
    'order'=>$order,
    'user'=>$user,


]);
//$product = Products::findOne($order->product_id);
//var_dump($product->ProductsServices);
}
    /**
     * @throws \yii\base\ExitException
     */
    protected function ajaxValidation($model)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        \Yii::$app->response->data = ActiveForm::validate($model);
        \Yii::$app->response->send();
        \Yii::$app->end();

    }
}