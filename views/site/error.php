<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use Yii;

use yii\helpers\Html;

$this->registerCssFile('/css/error.css');
?>

<div class="container">
    <div class="site-error">
    <div class="row">
        <h2 class="col-lg-12 col-xs-12">В следующий раз точно повезет!</h2>
    </div>
        <div class="row">


    <div class="img col-lg-3 col-xs-6"></div>

    </div>
        <div class="row">
            <a href="<?=Yii::$app->homeUrl?>" class="back">Перейти на главную</a>
        </div>
</div>

</div>
<style>
    /*Responsive max 600 px */
    @media only screen and (max-width: 600px) {
        .container{
            padding: 0!important;
        }
    }
</style>