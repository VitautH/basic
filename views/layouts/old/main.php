<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
$this->registerCssFile('css/main.css');

AppAsset::register($this);

print_r($model);
?>
<?php $this->beginPage() ?>
<?= $this->render('header', [
    'model' => $model,
]) ?>
<div class="container">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= $content ?>
</div>
</div>
<?= $this->render('footer', [
    'model' => $model,
]) ?>
<?php $this->endPage() ?>
