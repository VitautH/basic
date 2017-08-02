<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Page */

$this->registerCssFile('/css/pages.css');
$this->title = $model->title;
?>
<div class="clearfix"></div>
<div class="page-view">
    <div class="container">

        <div class="row">
            <div class="content col-lg-12 col-xs-12">
    <h1><?= Html::encode($this->title) ?></h1>

   <?= Html::decode($model->content); ?>

</div>
        </div>
    </div>
</div>