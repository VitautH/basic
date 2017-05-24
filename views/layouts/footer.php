<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use dektrium\user\widgets\Connect;
use dektrium\user\models\LoginForm;

use app\models\User;
use yii\widgets\ActiveForm;
if(Yii::$app->user->isGuest):
$model_login = \Yii::createObject(LoginForm::className());
    $model_registration = \Yii::createObject(User::className());
    $enablePasswordRecovery = true;
endif;
//ToDo: Вынести  в отдельные JS файлы!
?>


<footer>
    <div class="container">
   <div class="row">
       <div class="col-lg-4">

       </div>
       <div class="col-lg-2 footer_menu">
           <h3>О компании
           </h3>
           <ul>
               <li>Политика обработки ПД</li>
               <li>Новости</li>
               <li>Документы</li>
               <li>Контакты</li>
           </ul>
       </div>
       <div class="col-lg-2  footer_menu">
           <h3>О компании
           </h3>
           <ul>
               <li>Политика обработки ПД</li>
               <li>Новости</li>
               <li>Документы</li>
               <li>Контакты</li>
           </ul>
       </div>
       <div class="col-lg-2  footer_menu">
           <h3>О компании
           </h3>
           <ul>
               <li>Политика обработки ПД</li>
               <li>Новости</li>
               <li>Документы</li>
               <li>Контакты</li>
           </ul>
       </div>
   </div>
    </div>
</footer>
<?php

if(Yii::$app->session->getFlash('success_registration', NULL)!== null):
?>
    <div class="success_registration_message" id="success_registration_message">
        <div class="close" id="close_modal_success_registration_message">
            <span>x</span>
        </div>
        <div class="content">
            <p> <?=Yii::$app->session->getFlash('success_registration', NULL)  ?></p>
    </div>
<?php
endif;
?>
        <?php

        if(Yii::$app->session->getFlash('failed_registration', NULL)!== null):
        ?>
        <div class="failed_registration_message" id="failed_registration_message">
            <div class="close" id="close_modal_failed_registration_message">
                <span>x</span>
            </div>
            <div class="content">
                <p> <?=Yii::$app->session->getFlash('failed_registration', NULL)  ?></p>
            </div>
            <?php
            endif;
            ?>
<?php     if(Yii::$app->user->isGuest):
?>

<div class="login_singup_popup">
<div class="tabs">
    <div id="login_modal_form"  class="tab">
<span>ВОЙТИ</span>
    </div>
    <div id="singup_modal_form" class="active tab">
<span>ЗАРЕГИСТРИРОВАТЬСЯ</span>
    </div>
    <div class="close" id="close_modal_login_form">
<span>x</span>
    </div>
    <div class="modal_form" id="login_form">

        <?php $form = ActiveForm::begin([
                'action' => '/login',
            'id' => 'login-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'validateOnBlur' => true,
            'validateOnType' => false,
            'validateOnChange' => false,
        ]) ?>


            <?= $form->field($model_login, 'login',
                ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1', 'placeholder'=>'Логин']]
            )->label(false);
            ?>


            <?= $form->field(
                $model_login,
                'password',
                ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2',  'placeholder'=>'Пароль']])
                ->passwordInput()
                ->label(
                    Yii::t('user', 'Password')
                    . ($enablePasswordRecovery ?
                        ' (' . Html::a(
                            Yii::t('user', 'Забыли пароль?'),
                            ['/user/recovery/request'],
                            ['tabindex' => '5']
                        )
                        . ')' : '')
                )->label(false) ?>
<? //ToDO: Отключил Запомнить пароль  ?>
        <?//= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '3']) ?>

        <?= Html::submitButton(
            Yii::t('user', 'ВОЙТИ'),
            ['class' => 'btn btn-primary btn-block', 'tabindex' => '4']
        ) ?>

        <?php ActiveForm::end(); ?>

    </div>
    <div class="modal_form" id="singup_form">
        <?php $form = ActiveForm::begin([
            'id' => 'registration-form',
            'action' => '/registration',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'validateOnBlur' => true,
            'validateOnType' => false,
            'validateOnChange' => false,
        ]); ?>

        <?= $form->field($model_registration, 'email', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1','placeholder'=>'E-mail']])->label(false); ?>

        <?= $form->field($model_registration, 'username', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1','placeholder'=>'Логин']])->label(false); ?>

        <?= $form->field($model_registration, 'phone', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1','placeholder'=>'Телефон']])->label(false); ?>
            <?= $form->field($model_registration, 'password', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1','placeholder'=>'Пароль']])->passwordInput()->label(false); ?>


        <?= Html::submitButton(Yii::t('user', 'Зарегистрироваться'), ['class' => 'btn btn-primary btn-block']) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>

    </div>

</div>
</div>
<?
endif;
?>
<?php $this->endBody() ?>



<? if (!empty($this->context->slaidshow)) : ?>
    <?= $this->render('_slideshow', ['images' => $this->context->getSlaidshow()])?>
<? endif ?>

</body>
</html>