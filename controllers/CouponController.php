<?php

namespace app\controllers;

class CouponController extends \yii\web\Controller
{
    public $slug;
    public function actionIndex()
    {
        return $this->render('index');
    }

}
