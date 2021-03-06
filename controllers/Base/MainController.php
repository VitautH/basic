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
use app\models\Page;
use app\models\ModulesAdvantages;
use app\components\Lang;

class MainController extends \yii\web\Controller
{


    public $slaidshow;
    public $role_id;
    public $user_name;
    public $footer_menu;
    public $advantages;

// ToDo: Или методы класса или Свойства/члены. Конструктор переделать!
    public function __construct($id, $module, array $config = [])
    {
        $this->advantages = ModulesAdvantages::find()->asArray()->all();
        $this->footer_menu = Page::find()
            ->select('id, title, slug')
            ->where('menu_id = 1')
            ->asArray()
            ->all();

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

    public function beforeAction($action)
    {
        $lang = Yii::$app->request->get('lang');

        if (in_array($lang, Lang::$availableLangs)) {
            $cookies = Yii::$app->response->cookies;
            // add a new cookie to the response to be sent
            $cookies->add(new \yii\web\Cookie([
                'name' => 'language',
                'value' => $lang,
                'expire' => time() + 86400 * 365,
            ]));

            $session = Yii::$app->session;
            $session->set('language', $lang);
            \Yii::$app->language = $lang;
        }

        return parent::beforeAction($action); // TODO: Change the autogenerated stub
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