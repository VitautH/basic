<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Coupon;
use yii\widgets\ActiveForm;

$session = Yii::$app->session;
var_dump($session->getFlash('successful_paying'));

$this->title = _t('Список купонов');
$this->registerCssFile('/css/account.css');
$this->registerJSFile('/js/account.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<div class="main container">
    <div class="success-view">
        <div class="col-lg-11 col-xs-12">
            <div class="row">
                <h2><? _t('Заказы'); ?></h2>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-offset-1 col-lg-11 col-xs-12 col-sm-12">
                <div class="filter">
                </div>
            </div>
        </div>
        <div class="row">
            <div>
                <div class="unpaid_checkbox">
                </div>
            </div>
        </div>
        <div class="coupon_table_head col-lg-12 col-sm-12 ">
            <div class="col-lg-2 col-sm-2"><span><?= _t('Казино'); ?></span></div>
            <div class="col-lg-2 col-sm-2"><span><?= _t('Бонус-план'); ?></span></div>
            <div class="col-lg-2 col-sm-2"><span><?= _t('Цена'); ?></span></div>
            <div class="col-lg-2 col-sm-2"><span class="account-date"><span><?= _t('Дата'); ?></span></span></div>
            <div class="col-lg-2 col-sm-2"><span class="account-city"><span><?= _t('Город'); ?></span></span></div>
            <div class="col-lg-2 col-sm-2"><span class="account-actions"><span></span></span></div>
        </div>
        <div class="clearfix"></div>
        <? foreach ($model as $order): ?>
            <?= $this->render('_index_row', ['order' => $order]) ?>
        <? endforeach; ?>
    </div>
</div>
<div class="coupon_modal">
    <div class="close" id="close_modal_coupon">
        <span></span>
    </div>
    <div class="content">
        <?php if (\Yii::$app->language == 'en') {
            ?>
            <p>
                To use the Bonus Plan
                you need to provide the code when you visit the casino
            </p>
            <?
        } else {
            ?>
            <p>
                Чтобы воспользоваться Бонус планом Вам необходимо при посещении казино предоставить код
            </p>
            <?
        }
        ?>
        <div class="code">

        </div>
    </div>
</div>