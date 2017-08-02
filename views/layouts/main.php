<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
$this->registerCssFile('/css/main.css');
$this->registerCssFile('/css/trainee.css');
$this->registerCssFile('/css/normilize.css');
AppAsset::register($this);


?>
<?php $this->beginPage() ?>
<?= $this->render('header') ?>

<?= $content ?>
<?= $this->render('footer') ?>
<?php $this->endPage() ?>
