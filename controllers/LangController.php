<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\components\Lang;

class LangController extends Controller
{
    public $slug;
    public function actionChange($lang){
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
        }
        //ToDo: Home page language switch
        switch ($lang){
            case 'ru':
                $redirectUrl = str_replace("/en/", "/".$lang."/", Yii::$app->request->referrer);
                break;

            case 'en':
                $redirectUrl = str_replace("/ru/", "/".$lang."/", Yii::$app->request->referrer);
                break;
            default:
                $redirectUrl = Yii::$app->request->referrer;
                break;
        }

        return $this->redirect($redirectUrl);
    }
}