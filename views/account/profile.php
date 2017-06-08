<?php
/**
 * Created by PhpStorm.
 * User: Vitaut
 * Date: 03.05.2017
 * Time: 18:28
 */
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Coupon;
use yii\widgets\ActiveForm;
$this->title= 'Профиль пользователя';
$this->registerCssFile('/css/profile.css');
?>
<div class="container">
    <div class="profile-view">

            <div class="row">
                <h2 class="col-lg-12 col-lg-offset-1 col-xs-12 col-xs-offset-0">Личная информация</h2>
            </div>
        <?php
if(!empty($message)){
    echo $message;
}
        $form = ActiveForm::begin([

            'id' => 'profile-update-form',
            'options' => ['class' => 'profile-update-form col-lg-offset-4 col-xs-offset-0 '],
        ]) ?>
        <div class="clearfix">    </div>
            <span class="label col-lg-2 col-xs-3"> Имя </span>  <?= $form->field($model, 'firstname')->textInput(['class' => 'col-lg-4 col-xs-6'])->label(false)?>
            <div class="clearfix">    </div>
                <span class="label col-lg-2 col-xs-3"> Фамилия </span>  <?= $form->field($model, 'name')->textInput(['class' => 'col-lg-4 col-xs-6'])->label(false)?>
                <div class="clearfix">    </div>
                    <span class="label col-lg-2 col-xs-3"> Логин </span>  <?= $form->field($model, 'username')->textInput(['readonly' => !$model->isNewRecord,'class' => 'col-lg-4 col-xs-6'])->label(false)?>
                    <div class="clearfix">    </div>
                        <span class="label col-lg-2 col-xs-3"> Телефон </span>  <?= $form->field($model, 'phone')->input('tel',['class' => 'col-lg-4 col-xs-6'])->label(false)?>

        <div class="clearfix">    </div>
                            <span class="label col-lg-2 col-xs-3"> E-mail </span>   <?= $form->field($model, 'email')->input('email',['class' => 'col-lg-4 col-xs-6'])->label(false)?>

        <div class="clearfix">    </div>
       <span class="label col-lg-2 col-xs-3"> Текущий пароль </span> <?= $form->field($model, 'old_password')->passwordInput(['class' => 'col-lg-4 col-xs-6'])->label(false)?>
        <div class="clearfix">    </div>
        <span class="label col-lg-2 col-xs-3"> Новый пароль </span> <?= $form->field($model, 'password')->passwordInput(['class' => 'col-lg-4 col-xs-6'])->label(false)?>

                                <div class="clearfix">    </div>
        <?= Html::submitButton('СОХРАНИТЬ ИНФОРМАЦИЮ', ['class' => 'save-button col-lg-offset-1 col-xs-offset-0']) ?>


        <?php ActiveForm::end() ?>
</div>
</div>



</div>

<style>
    /*Responsive max 600 px */
    @media only screen and (max-width: 600px) {
        .container{
            padding: 0!important;
        }
    }
</style>