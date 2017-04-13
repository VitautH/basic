<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use moonland\tinymce\TinyMCE;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\base\Articles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textarea(['maxlength' => true]) ?>
    <?php $categories_items = $model->getCategoriesList();

    $params = [
        'prompt' => 'Выберите категорию'
    ];
    echo $form->field($model, 'category_id')->dropDownList($categories_items,$params);?>


    <?= $form->field($model, 'brief')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 10]) ?>

    <?= $form->field($model, 'date_published')->input('date') ?>
    <?= $form->field($model, 'imageFile')->fileInput()->hint('в формате png, jpg')->label("Главное изображение"); ?>

    <?= $form->field($model, 'archive')->checkbox() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
