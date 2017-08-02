<?php
/**
 * Created by PhpStorm.
 * User: Vitaut
 * Date: 13.06.2017
 * Time: 9:24
 */
use app\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php if(Yii::$app->session->getFlash('check_sms_code', NULL)!== null):
$array_message= Yii::$app->session->getFlash('check_sms_code', NULL);
?>
<div class="success_registration_message" id="success_registration_message">
        <div class="close" id="close_modal_success_registration_message">
            <span></span>
        </div>
        <div class="content">
            <p> Уважаемый, <?=$array_message['username']?>!</p>
<p> На Ваш телефон <b><?=$array_message['phone']?></b> отправлен код (<b><?=$array_message['key']?>)</b></p>
<?php
$model=new User;
$model->setScenario(User::SCENARIO_CHECK_REGISTER_CODE);
$form=ActiveForm::begin([
    'action' => '/registration/check-code',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'validateOnBlur' => true,
    'validateOnType' => false,
    'validateOnChange' => false,]);
echo $form->field($model, 'check_key')->textInput()->label(false);
echo Html::submitButton('Проверить код', ['class' =>  'btn_check_code']);
ActiveForm::end();
?>
</div>
    <?php
    endif;
    ?>