<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\CheckCoupon;

//$model = new CheckCoupon();
$this->registerCssFile('/css/manager.css');
$this->title = _t('Менеджер') . $username;
$model->setScenario(CheckCoupon::SCENARIO_CHECK_SMS_CODE);
?>
<div class="clearfix"></div>
<div class="container">
    <div class="manager-view">
        <div class="row">
            <div class="col-lg-12"><h2><?= _t('Менеджер'); ?> <?= $username ?>
                </h2></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                if (\Yii::$app->language == 'en') {
                    ?>
                    <p>
                        A verification code was sent (<?= $user->phone ?>) to the customer <?= $user->username ?>
                        (Отладка:<b><?= $sms_code ?></b>)
                    </p>
                    <?
                } else {
                    ?>

                    <p> Клиенту <?= $user->username ?>
                        на номер <?= $user->phone ?>
                        отправлен проверочный код (Отладка:<b><?= $sms_code ?></b>).
                    </p>
                    <?
                }
                ?>
                <?php $form = ActiveForm::begin(
                    [
                        'action' => '/'.\Yii::$app->language.'/manager/check-sms_code',

                        'enableAjaxValidation' => true,
                        'enableClientValidation' => true,
                        'validateOnBlur' => true,
                        'validateOnType' => false,
                        'validateOnChange' => false,
                    ]); ?>
                <?= $form->field($model, 'check_sms_code')->textInput() ?>
                <?= $form->field($model, 'coupon')->hiddenInput(['value' => $model->code])->label(false) ?>
                <?= Html::submitButton() ?>
                <?php
                ActiveForm::end();
                ?>
            </div>
        </div>
    </div>
</div>