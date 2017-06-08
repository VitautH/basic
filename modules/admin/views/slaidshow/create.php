<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use moonland\tinymce\TinyMCE;
use kartik\widgets\FileInput;

$this->title = 'Добавить слайд: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Слайды', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить';
?>

<div class="banner-form">
    <div class="col-lg-4">
        <h2>Модуль Слайдшоу</h2>
        <p>

            Загружайте, пожалуйста, изображения с минимальным  размером 1364 х 618 пиксилей.

        </p>
    </div>
    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal col-lg-8', 'enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => 255])->hint('Введите заголовок слайда')->label(true); ?>
    <?= $form->field($model, 'content')->textarea(['maxlength' => 255])->hint('Введите содержимое слайда')->label(true); ?>


    <?= $form->field($model, 'imageFile')->fileInput()->label("Изображение"); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
