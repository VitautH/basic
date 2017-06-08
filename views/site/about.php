<?php

/**
 * @var $this yii\web\View
 * @var $model \app\models\PageS
 */

use yii\helpers\Html;

$this->title = 'О нас';


?>

<div class="container">
    <div class="site-about">
        <img src="/image/logo.png" class="logo col-lg-4  col-lg-offset-4 col-xs-offset-0 col-xs-12 col-sm-6">
        <div class="site-about-inner">
            <h1><?=$model->title?></h1>

            <div class="brief">
                <?= $model->brief ?>
            </div>

            <div>
                _____________
            </div>

            <div class="page-content">
                <?= $model->content ?>
            </div>

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