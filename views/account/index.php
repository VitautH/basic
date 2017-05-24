<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Coupon;
use yii\widgets\ActiveForm;
$this->title= "Список купонов";

$this->registerCssFile('/css/account.css');
$this->registerJSFile('/js/account.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>


<div class="container">
    <div class="success-view">
        <div class="col-lg-11">
            <div class="row">
                <h2>Заказы</h2>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-offset-1 col-lg-11">
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

            <div class="coupon_table_head col-lg-12">
                <div class="col-lg-2"> <span>Казино</span> </div>
                    <div class="col-lg-2"> <span>План</span> </div>
                        <div class="col-lg-2">  <span>Цена</span> </div>
                            <div class="col-lg-2"> <span class="account-date"><span>Дата</span></span> </div>
                                <div class="col-lg-2">  <span class="account-city"><span>Город</span></span> </div>
                                    <div class="col-lg-2"> <span class="account-actions"><span></span></span> </div>
            </div>

<div class="clearfix"></div>
            <? foreach ($model as $order): ?>
                <?= $this->render('_index_row', ['order' => $order]) ?>
            <? endforeach; ?>
<!--                <div class="table-responsive">-->
<!--                    <table class="coupon_table table">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th><span>Казино</span></th>-->
<!--                            <th><span>План</span></th>-->
<!--                            <th><span>Цена</span></th>-->
<!--                            <th class="account-date"><span>Дата</span></th>-->
<!--                            <th class="account-city"><span>Город</span></th>-->
<!--                            <th class="account-actions"><span></span></th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!--                        --><?// foreach ($model as $order): ?>
<!--                            --><?//= $this->render('_index_row', ['order' => $order]) ?>
<!--                        --><?// endforeach; ?>
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->



</div>
</div>
<div class="coupon_modal">
    <div class="close" id="close_modal_coupon">
        <span>x</span>
    </div>
    <div class="content">
        <p>Чтобы воспользоваться Бонус планом Вам необходимо
            при посещении казино предоставить код</p>
        <div class="code"></div>


    </div>
</div>