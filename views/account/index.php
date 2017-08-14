<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Coupon;
use yii\widgets\ActiveForm;
use app\models\City;
$session = Yii::$app->session;

$this->title = _t('Список купонов');
$this->registerCssFile('/css/account.css');
$this->registerJSFile('/js/account.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
    <div class="main container">
        <div class="success-view">
            <div class="col-lg-11 col-xs-12">
                <div class="row">
                    <h2><?= _t('Заказы'); ?></h2>
                </div>
            </div>
            <div class="row">
                <div class=" col-lg-11 col-xs-12 col-sm-12">
                    <div class="filter">
                        <?php $form = ActiveForm::begin([
                            'id' => 'filter_form',

                        ]) ?>
                        <select id="city" class="form-control" >
                            <option disabled="" selected="" hidden=""><?= _t('Выбрать город')?></option>
                          <?php
                          foreach (City::find()->asArray()->all() as $city){
?>
                              <option value="<?=$city['id']?>"><?=$city['name']?></option>
    <?
                          }
?>
                        </select>
                        <input type="date" id="data" class="bonus_calendar bonus_calendar_orders" value="2017-07-11" name="bonus_calendar">
                        <div class="price_block ">
                            <h4><?= _t('Стоимость плана (в у.е)')?></h4>
                            <input type="number" class="price" name="min_price" step="1" min="0" max="100000" placeholder="<?= _t('от')?>">
                            <input type="number" class="price" name="max_price" step="1" min="0" max="100000" placeholder="<?= _t('до')?>">
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div>
                    <div class="unpaid_checkbox">
                        <input type="checkbox" id="unpaid_orders" class="unused_checkbox" name="unpaid_orders" value="">
                        <label for="unpaid_orders"><?=_t('Показать только непогашенные');?></label>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end() ?>
            <div class="coupon_table_head col-lg-12 col-sm-12 ">
                <div class="col-lg-3 col-sm-2"><span></span></div>
                <div class="col-lg-2 col-sm-2"><span><?= _t('Бонус-план'); ?></span></div>
                <div class="col-lg-1 col-sm-2"><span><?= _t('Цена'); ?></span></div>
                <div class="col-lg-1 col-sm-2"><span class="account-date"><span><?= _t('Дата'); ?></span></span></div>
                <div class="col-lg-1 col-sm-2"><span class="account-city"><span><?= _t('Город'); ?></span></span></div>
                <div class="col-lg-4 col-sm-2"><span class="account-actions"><span></span></span></div>
            </div>
            <div class="clearfix"></div>
            <div class="coupon">
            <? foreach ($model as $order): ?>
                <?= $this->render('_index_row', ['order' => $order]) ?>
            <? endforeach; ?>
            </div>
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
<?php if ($session->getFlash('successful_paying') !== null) {
    ?>
    <style>
        .overlay {
            display: block;
        }
    </style>

    <div class="payment_success">
        <div class="close" id="payment_success_coupon">
            <span></span>
        </div>
        <div class="content">
            <?php if (\Yii::$app->language == 'en') {
                ?>
                <p>
                    Successful payment. Your Bonus Code:
                </p>
                <?
            } else {
                ?>
                <p>
                    Поздравляем с успешной оплатой. Ваш Бонус-код:
                </p>
                <?
            }
            ?>
            <div class="code">
                <?= $session->getFlash('successful_paying'); ?>
            </div>
        </div>
    </div>
    <?php
}
?>