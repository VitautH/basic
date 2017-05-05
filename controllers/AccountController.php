<?php

namespace app\controllers;
use app\controllers\Base\MainController as MainController;
use app\models\User;
use app\models\Order;
use app\models\Products;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use Yii;
class AccountController extends MainController
{
    private $user;
    private $order;
    private $user_id;
    public function __construct($id, \yii\base\Module $module, array $config = [])
    {
        $this->user =  new User();
        $this->order= new Order();
  $this->user_id = Yii::$app->user->identity->getId();

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

    public function actionIndex()
    {

        return $this->render('index', [  'model' =>$this->order->findAll(['user_id' => $this->user_id, 'paid'=>1])]);
    }
    /**
     * Finds the Casino model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Casino the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
