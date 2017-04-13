<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use moonland\tinymce\TinyMCE;
use kartik\widgets\FileInput;
use app\modules\admin\models\Casino;
/* @var $this yii\web\View */
/* @var $model app\models\Casino */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="casino-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'meta_keywords')->textarea(['rows' => 3]) ?>
    <?= $form->field($model, 'meta_description')->textarea(['rows' => 3]) ?>



    <?php $city_items = $model->getCityList();

    $params = [
        'prompt' => 'Выберите город'
    ];
    echo $form->field($model, 'city_id')->dropDownList($city_items,$params);?>

    <?= $form->field($model, 'address_street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'imageFile')->fileInput()->hint('в формате png, jpg')->label("Логотип"); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
