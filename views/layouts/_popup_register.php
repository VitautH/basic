<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use dektrium\user\widgets\Connect;
use dektrium\user\models\LoginForm;

use app\models\User;
use yii\widgets\ActiveForm;

//    $model_registration = \Yii::createObject(User::className());
$model_registration = new User();
$model_registration->setScenario(User::SCENARIO_REGISTER);

?>


<?php $form = ActiveForm::begin([
    'id' => 'registration-form',
    'action' => '/registration',
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'validateOnBlur' => true,
    'validateOnType' => false,
    'validateOnChange' => false,
]); ?>

    <?= $form->field($model_registration, 'email', [
        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'E-mail']
    ])->label(false);
    ?>

    <?= $form->field($model_registration, 'username', [
        'inputOptions' => ['class' => 'form-control', 'placeholder' => _t('Логин')]
    ])->label(false);
    ?>

    <?= $form->field($model_registration, 'phone', [
        'inputOptions' => ['class' => 'form-control', 'placeholder' => _t('Телефон')]
    ])->label(false);
    ?>

    <?= $form->field($model_registration, 'password', [
        'inputOptions' => ['class' => 'form-control', 'placeholder' => _t('Пароль')]
    ])
    ->passwordInput()
    ->label(false);
?>


    <?= Html::submitButton(Yii::t('user', _t('Зарегистрироваться')), ['class' => 'btn btn-primary btn-block']) ?>

<?php ActiveForm::end(); ?>
