<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 08.05.2017
 * Time: 0:05
 *
<th class="account-date"><span>Дата</span></th>
<th class="account-city"><span>Город</span></th>
<th class="account-actions"><span></span></th>
 *
 */
use app\models\Order;
use app\models\Coupon;
use app\models\Services;
use app\models\Products;
?>
<?php if ($order->paid== 1):
?>

  <div class="coupon_table_body col-lg-12 col-xs-12" id="coupon_table_body_<?= $order->id?>">



      <div class="col-lg-2 col-xs-12 col-sm-2">
         <span class="coupon_table_head_phone col-xs-4">Казино: </span>
        <span class="casino_title col-xs-8 col-sm-12"><?= $order->product->casino->title; ?> </span>
        <br>
        <a class="to_more to_more_<?= $order->id ?>" data-content="<?= $order->id ?>" href="#">Подробнее</a>
          <a href="#" id="<?= $order->id?>" class="un_more un_more_<?= $order->id?>">Свернуть</a>
      </div>
      <div class="col-lg-2 col-xs-12 col-sm-2">
          <span class="coupon_table_head_phone col-xs-4">План: </span>
          <span class="plan_title col-xs-8 col-sm-12 "><?= $order->product->title; ?></span>
    </div>
      <div class="col-lg-2 col-xs-12 col-sm-2">
          <span class="coupon_table_head_phone col-xs-4">Цена: </span>
          <span class="price_title col-xs-8 col-sm-12"><?= $order->amount; ?></span>
      </div>
    <div class="account-date col-lg-2 col-xs-12 col-sm-2">
        <span class="account-date"><span class="coupon_table_head_phone col-xs-4">Дата: </span></span>
        <span class="date_title  col-xs-8 col-sm-12"><?= Yii::$app->formatter->asDatetime($order->created_at, 'dd.MM.yyyy'); ?></span>
    </div>
    <div class="account-city col-lg-2 col-xs-12 col-sm-2">
        <span class="account-city"><span class="coupon_table_head_phone col-xs-4">Город: </span></span>
        <span class="city_title col-xs-8 col-sm-12"><?= $order->product->casino->city->name; ?></span>
    </div>
<div class="col-xs-12 coupon_table_head_phone">
    <a class="to_more_phone to_more_<?= $order->id ?>" data-content="<?= $order->id ?>" href="/products/view?id=<?=$order->product->id?>">Подробнее</a>
</div>
    <div class="account-actions col-lg-2 col-xs-12 col-sm-2">
        <? if ($order->coupons['status'] == Coupon::UNUSED) : ?>
            <span class="casino-button button-unused"><a data-content="<?= $order->coupons->coupon?>" class="unused_click" href="#">показать</a></span>
        <? endif;
        if ($order->coupons['status'] == Coupon::USED) : ?>
            <span class="casino-button button-used"><a href="">ПОГАШЕН</a></span>

        <? endif; ?>
    </div>
    </div>
    <div class="more col-lg-12" id="more_<?=$order->id?>">
        <div class="left_block col-lg-3 col-sm-4">

            <div class="img">    <?php if ($order->product->logo_id != null) {
                ?>
                <img  width="270" height="270"  src="<?= Yii::$app->imagemanager->getImagePath($order->product->logo_id, '270', '270','inset')?>"/>
            </div>
            <?php
            }
            else {
            ?>
            <img src="/image/noimg.jpg" width="270px" height="270px"></div>
        <?
        }
        ?></div>
        <div class="right_block col-lg-8 col-sm-8">
            <div class="description">
                <span class="title_description">Описание:</span>
                <p><?= $order->product->description;?></p>
            </div>
            <div class="cashback">
                <span class="title_cashback">Кэшбэк:</span>
                <p> <?= $order->product->cashback;?> BYN </p>
            </div>
            <div class="included_service">
                <span class="title_included_service">Включенные услуги:</span>
                <ul>
                    <?php foreach ($order->product->productsServices as $product_service):
                        $id = $product_service->id_service;
                        ?>
                        <li><?=Services::findOne($id)->name;?></li>
                        <?


                    endforeach;


                    ?>
                </ul>
            </div></div>
    </div>
    <div class="clearfix"></div>
<?php
endif;
?>