<?php
/**
 * Created by PhpStorm.
 * User: Vitaut
 * Date: 08.06.2017
 * Time: 17:13
 */
use app\models\Services;

$this->title = "Информация о заказе";
$this->registerCssFile('/css/account.css');
?>

<div class="main container">
    <div class="success-view">
        <div class="col-lg-11 col-xs-12">
            <div class="row">
                <h2><?= $this->title ?></h2>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-offset-1 col-lg-11 col-xs-12 col-sm-12">
                <div class="filter">

                </div>

            </div>
        </div>


        <div class="coupon_table_head col-lg-12 col-sm-12 ">
            <div class="col-lg-2 col-sm-2"><span><?= _t('Казино') ?></span></div>
            <div class="col-lg-2 col-sm-2"><span><?= _t('Бонус-план') ?></span></div>
            <div class="col-lg-2 col-sm-2"><span><?= _t('Кэшбэк') ?></span></div>
            <div class="col-lg-2 col-sm-2"><span class="account-date"><span><?= _t('Включенные услуги') ?></span></span>
            </div>
            <div class="col-lg-2 col-sm-2"><span class="account-city"><span><?= _t('Пользователь') ?></span></span>
            </div>
            <div class="col-lg-2 col-sm-2"><span class="account-actions"><span></span></span></div>
        </div>

        <div class="clearfix"></div>
        <div class="coupon_table_body col-lg-12 col-xs-12" id="coupon_table_body_<?= $order->id ?>">


            <div class="col-lg-2 col-xs-12 col-sm-2">
                <span class="coupon_table_head_phone col-xs-4"><?= _t('Казино') ?>: </span>
                <span class="casino_title col-xs-8 col-sm-12"><a
                            href="/<?= \Yii::$app->language; ?>/casino/view?id=<?= $order->product->casino->id ?>"> <?= $order->product->casino->title; ?></a> </span>


            </div>
            <div class="col-lg-2 col-xs-12 col-sm-2">
                <span class="coupon_table_head_phone col-xs-4"><?= _t('Бонус-план') ?>: </span>
                <span class="plan_title col-xs-8 col-sm-12 "><a
                            href="/<?= \Yii::$app->language; ?>/products/view?id=<?= $order->product->id ?>"><?= $order->product->title; ?></a></span>
            </div>
            <div class="col-lg-2 col-xs-12 col-sm-2">
                <span class="coupon_table_head_phone col-xs-4"><?= _t('Кэшбэк') ?>: </span>
                <span class="price_title col-xs-8 col-sm-12"><?= $order->product->cashback; ?> $</span>
            </div>
            <div class="account-date col-lg-2 col-xs-12 col-sm-2">
                <span class="account-date"><span class="coupon_table_head_phone col-xs-4"><?= _t('Включенные услуги') ?>
                        : </span></span>
                <span class="date_title  col-xs-8 col-sm-12">
                     <ul>
                    <?php foreach ($order->product->productsServices as $product_service):
                        $id = $product_service->id_service;
                        ?>
                        <li><?= Services::findOne($id)->name; ?></li>
                        <?
                    endforeach
                    ?>
                </ul>
                </span>
            </div>
            <div class="account-city col-lg-3 col-xs-12 col-sm-3">
                <span class="account-city"><span class="coupon_table_head_phone col-xs-4"><?= _t('Пользователь'); ?>
                        : </span></span>
                <span class="city_title col-xs-8 col-sm-12"><?= $user->firstname; ?> <?= $user->name; ?>
                    <br>
                    <?= $user->phone ?>
                </span>
            </div>
            <div class="col-xs-12 coupon_table_head_phone">
                <a class="to_more_phone to_more_<?= $order->id ?>" data-content="<?= $order->id ?>"
                   href="/<?= \Yii::$app->language; ?>/products/view?id=<?= $order->product->id ?>">Подробнее</a>
            </div>
        </div>
        <div class="more col-lg-12" id="more_<?= $order->id ?>">
            <div class="left_block col-lg-3 col-sm-4">

                <div class="img">    <?php if ($order->product->logo_id != null) {
                    ?>
                    <img width="270" height="270"
                         src="<?= Yii::$app->imagemanager->getImagePath($order->product->logo_id, '270', '270', 'inset') ?>"/>
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
                <span class="title_description"><?= _t('Описание');?>:</span>
                <p><?= $order->product->description; ?></p>
            </div>
            <div class="cashback">
                <span class="title_cashback"><?= _t('Кэшбэк');?>:</span>
                <p> <?= $order->product->cashback; ?> BYN </p>
            </div>
            <div class="included_service">
                <span class="title_included_service"><?= _t('Включенные услуги');?>:</span>
                <ul>
                    <?php foreach ($order->product->productsServices as $product_service):
                        $id = $product_service->id_service;
                        ?>
                        <li><?= Services::findOne($id)->name; ?></li>
                        <?
                    endforeach;
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
</div>

