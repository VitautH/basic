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

$this->title = _t('Профиль пользователя');
$this->registerCssFile('/css/profile.css');
?>
<div class="container">
    <div class="profile-view">

        <div class="row">
            <h2 class="col-lg-12 col-lg-offset-1 col-xs-12 col-xs-offset-0"><?= _t('Личная информация'); ?></h2>
        </div>
        <?php
        if (!empty($message)):
        ?>
        <div class="row">
            <div class="alert alert-success  col-lg-4 col-lg-offset-5 col-xs-12 col-xs-offset-0">
                <?= $message; ?>
            </div>
            <?
            endif;

            ?>
            <?php
            $form = ActiveForm::begin([

                'id' => 'profile-update-form',
                'options' => ['class' => 'profile-update-form col-lg-offset-4 col-xs-offset-0 '],
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                'validateOnBlur' => true,
                'validateOnType' => false,
                'validateOnChange' => false,
            ]) ?>
            <div class="clearfix"></div>
            <span class="label col-lg-2 col-xs-3"> <?= _t('Имя'); ?>  </span>
            <div class="col-lg-4 col-xs-6"> <? echo $form->field($model, 'name')->begin();
                echo Html::activeTextInput($model, 'name', ['class' => 'col-lg-12 col-xs-12']); //Field
                echo Html::error($model, 'name', ['class' => 'help-block']); //error
                echo $form->field($model, 'name')->end();
                ?>
            </div>
            <div class="clearfix"></div>
            <span class="label col-lg-2 col-xs-3"> <?= _t('Фамилия'); ?>  </span>
            <div class="col-lg-4 col-xs-6"> <? echo $form->field($model, 'firstname')->begin();
                echo Html::activeTextInput($model, 'firstname', ['class' => 'col-lg-12 col-xs-12']); //Field
                echo Html::error($model, 'firstname', ['class' => 'help-block']); //error
                echo $form->field($model, 'firstname')->end();
                ?>
            </div>
            <div class="clearfix"></div>
            <span class="label col-lg-2 col-xs-3"> <?= _t('Логин'); ?>  </span>
            <div class="col-lg-4 col-xs-6">
                <?= $form->field($model, 'username')->textInput(['readonly' => !$model->isNewRecord, 'class' => 'col-lg-12 col-xs-12'])->label(false) ?>

            </div>
            <div class="clearfix"></div>
            <span class="label col-lg-2 col-xs-3"> <?= _t('Телефон'); ?>  </span>
            <div class="col-lg-4 col-xs-6"> <? echo $form->field($model, 'phone')->begin();
                echo Html::activeInput('phone', $model, 'phone', ['class' => 'col-lg-12 col-xs-12']); //Field
                echo Html::error($model, 'phone', ['class' => 'help-block']); //error
                echo $form->field($model, 'phone')->end();
                ?>
                <p class="info"><?= _t('При обновлении телефона  Вам будет отправлен проверочный код на новый номер'); ?>
                    .</p>
            </div>

            <div class="clearfix"></div>
            <span class="label col-lg-2 col-xs-3"> E-mail </span>

            <div class="col-lg-4 col-xs-6"> <? echo $form->field($model, 'email')->begin();
                echo Html::activeInput('email', $model, 'email', ['class' => 'col-lg-12 col-xs-12']); //Field
                echo Html::error($model, 'email', ['class' => 'help-block']); //error
                echo $form->field($model, 'email')->end();
                ?>
            </div>


            <div class="clearfix"></div>
            <span class="label col-lg-2 col-xs-3"> <?= _t('Новый пароль'); ?>  </span>
            <div class="col-lg-4 col-xs-6"> <? echo $form->field($model, 'password')->begin();
                echo Html::activePasswordInput($model, 'password', ['class' => 'col-lg-12 col-xs-12']); //Field
                echo Html::error($model, 'password', ['class' => 'help-block']); //error
                echo $form->field($model, 'password')->end();
                ?>
            </div>

            <div class="clearfix"></div>


            <span class="label col-lg-2 col-xs-3"> <?= _t('Текущий пароль'); ?>   </span>

            <div class="col-lg-4 col-xs-6">
                <? echo $form->field($model, 'old_password')->begin();
                echo Html::activePasswordInput($model, 'old_password', ['class' => 'col-lg-12 col-xs-12']); //Field
                echo Html::error($model, 'old_password', ['class' => 'help-block']); //error
                echo $form->field($model, 'old_password')->end();
                ?>
                <p class="info"><?= _t('Для обновления профиля  введите текущий пароль'); ?>.</p>
            </div>
            <div class="clearfix"></div>
            <?= Html::submitButton(_t('Сохранить данные'), ['class' => 'save-button col-lg-offset-1 col-xs-offset-0']) ?>


            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
<style>
    /*Responsive max 600 px */
    @media only screen and (max-width: 600px) {
        .container {
            padding: 0 !important;
        }
    }
</style>