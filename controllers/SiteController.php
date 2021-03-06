<?php

namespace app\controllers;

use app\controllers\Base\MainController as MainController;
use app\models\base\Products;
use app\models\Casino;
use app\models\Page;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Articles;
use app\models\Banners;
use app\models\Menu;

use yii\web\NotFoundHttpException;
class SiteController extends MainController
{
public $slug;
public $footer_menu;
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            /*           'error' => [
                           'class' => 'yii\web\ErrorAction',
                       ],*/
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $articles = Articles::find()->limit(3)->all();

        $casinos_slider_img = Casino::find()->where(['not', ['logo_id' => NULL]])->all();

        // Вывод баннера на левый сайтбар. ToDo: Убрать лимит 1 ?
        $banner = Banners::find()->one();
        // ToDo: Сделать галочку отобразить на главной, Random, limit 4
        $products = Products::find()->limit(4)->all();

$this->footer_menu = Page::find()
    ->select('id, title, slug')
    ->where('menu_id = 1')
    ->asArray()
    ->all();
        return $this->render('index', ['articles' => $articles, 'casinos_slider_img' => $casinos_slider_img, 'banner' => $banner, 'products' => $products,  'footer_menu'=> $this->footer_menu]);

    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $this->slaidshow= null;
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }


//    /**
//     * Displays slug pages.
//     *
//     * @return array
//     */
//    protected function findModelBySlug($slug)
//    {
//        var_dump($slug);
//        die();
//        if (($model = Page::findOne(['slug' => $slug])) !== null) {
//            return $model;
//        } else {
//            throw new NotFoundHttpException();
//        }
//    }
//    public function actionView($slug)
//    {
//        return $this->render('view', [
//            'model' => $this->findModelBySlug($slug),
//        ]);
//    }
public function actionAbout(){
    $this->slaidshow = null;
    $this->slug= 'about';
    $model =Page::findOne(['slug' =>  $this->slug]);
   if ($model !== null) {


       return $this->render('about', ['model' => $model]);
   }
   else {
       Yii::$app->response->setStatusCode('404');
       throw new NotFoundHttpException();
   }

}
    public function actionError()
    {
        $this->slaidshow = null;

        Yii::$app->response->setStatusCode('404');

        return $this->render('error', []);

//        \yii\web\ErrorAction::
    }
}
