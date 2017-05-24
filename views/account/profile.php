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
                <h2 class="col-lg-12 col-lg-offset-1">Личная информация</h2>
            </div>
        <?php

        $form = ActiveForm::begin([
            'action' =>['account/profile-update'],
            'id' => 'profile-update-form',
            'options' => ['class' => 'profile-update-form col-lg-offset-4 '],
        ]) ?>
        <div class="clearfix">    </div>
            <span class="label col-lg-2"> Имя </span>  <?= $form->field($model, 'firstname')->textInput(['class' => 'col-lg-4'])->label(false)?>
            <div class="clearfix">    </div>
                <span class="label col-lg-2"> Фамилия </span>  <?= $form->field($model, 'name')->textInput(['class' => 'col-lg-4'])->label(false)?>
                <div class="clearfix">    </div>
                    <span class="label col-lg-2"> Логин </span>  <?= $form->field($model, 'username')->textInput(['readonly' => !$model->isNewRecord,'class' => 'col-lg-4'])->label(false)?>
                    <div class="clearfix">    </div>
                        <span class="label col-lg-2"> Телефон </span>  <?= $form->field($model, 'phone')->input('tel',['class' => 'col-lg-4'])->label(false)?>

        <div class="clearfix">    </div>
                            <span class="label col-lg-2"> E-mail </span>   <?= $form->field($model, 'email')->input('email',['class' => 'col-lg-4'])->label(false)?>

        <div class="clearfix">    </div>
       <span class="label col-lg-2"> Пароль </span> <?= $form->field($model, 'password')->passwordInput(['class' => 'col-lg-4'])->label(false)?>

                                <div class="clearfix">    </div>
        <?= Html::submitButton('СОХРАНИТЬ ИНФОРМАЦИЮ', ['class' => 'save-button col-lg-offset-1']) ?>


        <?php ActiveForm::end() ?>
</div>
</div>



</div>