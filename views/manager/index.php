<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\CheckCoupon;
//$model = new CheckCoupon();
$this->registerCssFile('/css/manager.css');
$this->title= 'Менеджер'.$username;
$model->setScenario(CheckCoupon::SCENARIO_CHECK_COUPON_CODE);
?>
<div class="clearfix"></div>
<div class="container">
    <div class="manager-view">
        <div class="row">
            <div class="col-lg-12">  <h2>Менеджер <?=$username?>
                </h2></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <?php $form = ActiveForm::begin(
                    [


               'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'validateOnBlur' => true,
                'validateOnType' => false,
                'validateOnChange' => false,
                ]);?>
            <?=$form->field($model,'code')->textInput()?>
            <?=Html::submitButton()?>
            <?php
            ActiveForm::end();
            ?>
        </div>
        </div>
    </div>
</div>