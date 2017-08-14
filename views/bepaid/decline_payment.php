<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */


use yii\helpers\Html;

$this->registerCssFile('/css/error.css');
?>

<div class="container">
    <div class="site-error">
        <div class="row">
            <div class="alert alert-danger col-lg-12 col-xs-12"><?= $message; ?>!</div>
        </div>
    </div>

</div>
<style>
    /*Responsive max 600 px */
    @media only screen and (max-width: 600px) {
        .container {
            padding: 0 !important;
        }
    }
</style>