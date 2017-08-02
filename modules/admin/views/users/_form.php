<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
if(isset($create)) {
    $model= new User();
    $model->setScenario(User::SCENARIO_CREATE);
}
if(isset($update)){
    $model->setScenario(User::SCENARIO_UPDATE_ADMIN);
}

?>

<div class="user-form">

    <?php $form = ActiveForm::begin([


        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'validateOnBlur' => true,
        'validateOnType' => false,
        'validateOnChange' => false,
    ]); ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
<?=$form->field($model, 'role_id')->dropDownList([User::BUYER=>'Покупатель',User::MANAGER=>'Менеджер', User::ADMIN=>'Администратор'])?>
    <?=$form->field($model, 'flags')->dropDownList([0=>'Заблокировать',1=>'Активировать'])?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
