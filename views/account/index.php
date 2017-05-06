<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Coupon;
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
            <th><span>Казино</span></th>
            <th><span>План</span></th>
            <th><span>Цена</span></th>
            <th><span>Дата</span></th>
            <th><span>Город</span></th>
        </tr>
        </thead>
        <tbody>

        <? foreach ($model as $order):?>
            <tr>
                <td><span class="casino_title"><?= $order->product->casino->title; ?> </span>
                    <br>
                    <a class="more" id="<?=$order->id ?>" href="#">Подробнее</a>

                </td>
                <td><span class="plan_title"><?= $order->product->title; ?></span></td>
                <td><span class="price_title"><?= $order->amount; ?></span></td>
                <td><span class="date_title"><?= Yii::$app->formatter->asDatetime($order->created_at, 'dd.MM.yyyy');?></span></td>
                <td><span class="city_title"><?= $order->product->casino->city->name; ?></span></td>
                <td>
                <td><?
                switch ($order->coupons->status){
                    case Coupon::UNUSED:
                        ?>
                        <a href="#" class="unused">Предявить</a>
                    <?

                        break;

                    case Coupon::USED:
                        ?>
                    <span class="used">Использован</span>

                    <?
                        break;
                }




                    ?>


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