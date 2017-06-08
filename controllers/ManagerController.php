<?php

namespace app\controllers;

use app\models\CheckCoupon;
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
                \Yii::$app->response->format = Response::FORMAT_JSON;
                \Yii::$app->response->data = ActiveForm::validate($model);
                \Yii::$app->response->send();
                \Yii::$app->end();
            }
           else {
                if($model->validate()){
                   // return $this->ac
                }
           }

        }

        return $this->render('index', [
            'username' => $this->user_name,
            'model' => $model
        ]);


    }

    public function actionCheckCoupon()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {

            $model = new CheckCoupon();
            $model->setScenario(CheckCoupon::SCENARIO_CHECK_COUPON_CODE);

            $this->ajaxValidation($model);

            $model->load($request->post());
//            return $this->render('index', [
//                    'username' => $this->user_name,
//                    'model' => $model,
//
//                ]);
//            if ($model->check() !== null) {
//                return $this->render('index', [
//                    'username' => $this->user_name,
//                    'model' => $model
//                ]);
//            } else {
//
//                return $this->render('index', [
//                    'username' => $this->user_name,
//                    'model' => $model,
//
//                ]);
//            }
        }
    }

    /**
     * @throws \yii\base\ExitException
     */
    protected function ajaxValidation($model)
    {
        if (\Yii::$app->request->isAjax) {
            $model->load(\Yii::$app->request->post());


            \Yii::$app->response->format = Response::FORMAT_JSON;
            \Yii::$app->response->data = ActiveForm::validate($model);


            \Yii::$app->response->send();
            \Yii::$app->end();
        }
    }
}