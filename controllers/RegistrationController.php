<?php
/**
 * Created by PhpStorm.
 * User: Vitaut
 * Date: 19.04.2017
 * Time: 17:51
 */
/*
ToDo: 1) Проверка смс
2) Проверка e-mail
3) Подробный вывод сообщений об ошибках.
 */
namespace app\controllers;

use app\controllers\Base\MainController as MainController;
use app\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use Yii;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use yii\web\Response;
use yii\widgets\ActiveForm;


class RegistrationController extends MainController
{
    use AjaxValidationTrait;
    use EventTrait;
    private $user;
    public $slug;


    public function beforeAction($action)
    {

        $this->slaidshow = null;

        if ($this->getRole() !== User::GUEST) {
            throw new ForbiddenHttpException('Доступ запрещён');
        } else {
            return parent::beforeAction($action);

        }
    }

    // Точка входа регистрации
    public function actionIndex()
    {


        if (Yii::$app->request->isPost) {

            $request = Yii::$app->request;
//            $user = Yii::createObject(User::className());
            $user = new User();
            $user->setScenario(User::SCENARIO_REGISTER); // Устанавливаем сценарий

//            $event = $this->getFormEvent($user);
            $this->ajaxValidation($user);

            if ($user->registration($request->post())) {
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->session->setFlash(
                    'failed_registration', 'Извините, произошла ошибка во время регистрации!'

                );
                return $this->redirect([Yii::$app->request->referrer]);
            }

        } else {

            throw new ForbiddenHttpException('Доступ запрещён');
        }

    }


    /**
     * @throws \yii\base\ExitException
     */
    protected function ajaxValidation($model)
    {
        if (\Yii::$app->request->isAjax) {
            $model->load(\Yii::$app->request->post());
//            $model->validate();

            \Yii::$app->response->format = Response::FORMAT_JSON;
            \Yii::$app->response->data   = ActiveForm::validate($model);

//            \Yii::$app->response->data = [
//                'status'    => $model->validate() ? 'ok' : 'error',
//                'errors'    => $model->getErrors(),
//            ];

//            \Yii::$app->response->data   = $model->validate();

//            \Yii::$app->response->errors   = $model->getErrors();
            \Yii::$app->response->send();
            \Yii::$app->end();
        }
    }


}