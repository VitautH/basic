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

       <div class="col-lg-2 col-xs-6 footer_menu">

           <ul>
               <?php

               foreach ($this->context->footer_menu as $menu_items):
                   ?>
                   <li><a href="/<?=\Yii::$app->language;?>/page/<? if($menu_items['slug']!== null){
                       echo  $menu_items['slug'];}
                   else {
                       echo  $menu_items['id'];

                       }?>"><?=$menu_items['title']?></a> </li>
                   <?
               endforeach;
               ?>
           </ul>
       </div>

   </div>
    </div>
</footer>
<?=$this->render('_popup_check_sms');?>

        <?php

        if(Yii::$app->session->getFlash('failed_registration', NULL)!== null):
        ?>
        <div class="failed_registration_message" id="failed_registration_message">
            <div class="close" id="close_modal_failed_registration_message">
                <span></span>
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
<span><?= _t('Войти');  ?></span>
    </div>
    <div id="singup_modal_form" class="active tab">
<span><?= _t('Зарегистрироваться');?></span>
    </div>
    <div class="close" id="close_modal_login_form">
<span></span>
    </div>
    <div class="modal_form" id="login_form">

        <?=$this->render('_popup_login');?>

    </div>
    <div class="modal_form" id="singup_form">
        <?=$this->render('_popup_register');?>
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