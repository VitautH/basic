<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use yii\widgets\ActiveForm;
$this->registerCssFile('/css/account.css');
?>




    <div class="container">
        <div class="success-view">
            <div class="col-lg-offset-1 col-lg-11">
        <div class="row">
            <h2>Личный кабинет</h2>
<?php //var_dump($model); ?>
        </div>
            </div>
            <div class="row">
                <div class="col-lg-offset-1 col-lg-11">
<div class="filter">

</div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-offset-1 col-lg-11">
                <div class="unpaid_checkbox">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-offset-1 col-lg-11">
<div class="table-responsive">
    <table class="coupon_table table">
        <thead>
        <tr>
            <th>Казино</th>
            <th>План</th>
            <th>Цена</th>
            <th>Дата</th>
            <th>Город</th>
        </tr>
        </thead>
        <tbody>

        <? foreach ($model as $order):?>
            <tr>
                <td><span class="casino_title"><?= $order->product->casino->title; ?> </span>
                    <br>
                    <a href="#">Подробнее</a>
                </td>
                <td><?= $order->product->title; ?></td>
                <td><?= $order->amount; ?></td>
                <td>john@example.com</td>
                <td><?= $order->product->casino->city->name; ?></td>
                <td>
                    <a href="#" class="pay">Оплатить</a>
                    <a href="#" class="delete">Удалить</a>
                </td>
            </tr>
            <? endforeach; ?>

        </tbody>
    </table>


</div>
                </div>
            </div>

    </div>
</div>