<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use moonland\tinymce\TinyMCE;
use kartik\widgets\FileInput;

$this->title = 'Создать Баннер: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Баннеры', 'url' => ['create']];
$this->params['breadcrumbs'][] = 'Создать';
?>

<div class="banner-form">
    <div class="col-lg-4">
        <h2>Модуль Баннер</h2>
        <p>

            Загружайте, пожалуйста, изображения размером 295 х 618 пиксилей.

        </p>
    </div>
    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal col-lg-8', 'enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => 255])->hint('Введите название партнера')->label(true); ?>
    <?= $form->field($model, 'url')->textInput(['maxlength' => 255])->hint('Например, http://ya.ru')->label(true); ?>

    <?= $form->field($model, 'imageFile')->fileInput()->label("Изображение"); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
