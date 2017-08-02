<?php
/**
 * Created by PhpStorm.
 * User: Vitaut
 * Date: 19.04.2017
 * Time: 17:51
 */
/*
ToDo: Ошибка с редиректом! Исправить!!!
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

    /*
     *    Точка входа регистрации
     */

    public function actionIndex()
    {


        if (Yii::$app->request->isPost) {


            /*
             * Создаём модель
             */
            $user = new User();

            /*
             *  Устанавливаем сценарий
             */
            $user->setScenario(User::SCENARIO_REGISTER);
            $user->load($_POST);
            /*
             *  Validation
             */
            if (\Yii::$app->request->isAjax) {
              return  $this->ajaxValidation($user);
            }
            else
                {
                if ($user->validate()) {
                   if($user->Registration()){
                       Yii::$app->session->setFlash(
                           'success_registration', ['phone'=>$user->phone, 'username'=>$user->username, 'key'=>$user->secret_key]

                       );
                       return $this->redirect([Yii::$app->homeUrl]);
                   }
                }
                else {
                    Yii::$app->session->setFlash(
                        'failed_registration', 'Извините, произошла ошибка во время регистрации!'

                    );
                    return $this->redirect([Yii::$app->homeUrl]);
                }
            }


        } else {

            throw new ForbiddenHttpException('Доступ запрещён');
        }

    }

public function actionCheckCode(){
    $model = new User();
    if (!empty($_POST)) {
        $model->setScenario(User::SCENARIO_CHECK_REGISTER_CODE);
        $model->load($_POST);

        if (\Yii::$app->request->isAjax) {
            return  $this->ajaxValidation($model);
        } else {
            if ($model->validate()) {
              $model->activationUser();
                   return $this->redirect([Yii::$app->homeUrl]);




            }
        }

    }
   else{
        //throw new NotFoundHttpException('The requested page does not exist.');
    }
}
    /**
     * @throws \yii\base\ExitException
     */
    protected function ajaxValidation($model)
    {

        $model->load(\Yii::$app->request->post());

        \Yii::$app->response->format = Response::FORMAT_JSON;
        \Yii::$app->response->data = ActiveForm::validate($model);


        \Yii::$app->response->send();
        \Yii::$app->end();

    }


}