<?php


namespace app\controllers\Base;

use app;
use Yii;
use app\models\base\Articles;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use  app\models\Slaidshow;

class MainController extends \yii\web\Controller
{


    public $slaidshow;
    public $role_id;
    public $user_name;

// ToDo: Или методы класса или Свойства/члены. Конструктор переделать!
    public function __construct($id, $module, array $config = [])
    {
        $this->slaidshow = Slaidshow::find()->asArray()->all();

        if (!Yii::$app->user->isGuest) {
            $this->role_id = Yii::$app->user->identity->role_id;
            $this->user_name = Yii::$app->user->identity->username;
        } else {
            $this->role_id = null;
            $this->user_name = null;
        }
        parent::__construct($id, $module, $config);
    }

    public function getSlaidshow()
    {
        return $this->slaidshow;
    }

    public function getRole()
    {

        return $this->role_id;

    }

    public function getUserName()
    {
        return $this->user_name;
    }

    public function getLinkAccaunt()
    {
        $user = new User;

        switch ($this->role_id) {
            case $user::ADMIN:
                return '/admin';
                break;

            case $user::BUYER:

                return '/account';
                break;

            case $user::MANAGER:

                return '/manager';
                break;
        }
    }


}