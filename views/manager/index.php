<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\CheckCoupon;

//$model = new CheckCoupon();
$this->registerCssFile('/css/manager.css');
$this->title = _t('Менеджер') .' '. $username;
$model->setScenario(CheckCoupon::SCENARIO_CHECK_COUPON_CODE);
?>
<div class="clearfix"></div>
<div class="container">
    <div class="manager-view">
        <div class="row">
            <div class="col-lg-12">
                <h2><?= $this->title; ?></h2>
                <span><?= _t('Казино'); ?>: {casino}</span></div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-lg-offset-1">
                <?php $form = ActiveForm::begin(
                    [
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => true,
                        'validateOnBlur' => true,
                        'validateOnType' => false,
                        'validateOnChange' => false,
                    ]); ?>
                <?= $form->field($model, 'code')->textInput()->label(_t('Проверочный код')); ?>
                <?= Html::submitButton() ?>
                <?php
                ActiveForm::end();
                ?>
            </div>
            <div class="information col-lg-4">
                <?php
                if (\Yii::$app->language == 'en') {
                    ?>
                    <p>To verify the Coupon, enter the coupon code provided by the user.
                     If the Coupon code is correct and the Coupon status is "Not redeemed",then the user will be sent a verification Code to phone number</p>
                    <?php
                } else {
                    ?>
                    <p>Для проверки Купона введите код Купона, предоставленным пользователем.
                        Если код Купона верный и статус Купона "Не погашен", то пользователю будет отправлен проверочный
                        код на номер телефона</p>

                    <?
                }

                ?>

            </div>
        </div>
    </div>
</div>