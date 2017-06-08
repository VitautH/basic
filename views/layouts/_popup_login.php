<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 6/1/2017
 * Time: 4:00 PM
 */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use dektrium\user\widgets\Connect;
use dektrium\user\models\LoginForm;

use app\models\User;
use yii\widgets\ActiveForm;

$model_login = \Yii::createObject(LoginForm::className());
//$model_login = new LoginForm();

$enablePasswordRecovery = true;

?>

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
    ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1', 'placeholder' => 'Логин']]
)->label(false);
?>


<?= $form->field(
    $model_login,
    'password',
    ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2', 'placeholder' => 'Пароль']])
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
<? //ToDO: Отключил Запомнить пароль
?>
<? //= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '3'])?>

<?= Html::submitButton(
    Yii::t('user', 'ВОЙТИ'),
    ['class' => 'btn btn-primary btn-block', 'tabindex' => '4']
) ?>

<?php ActiveForm::end(); ?>
