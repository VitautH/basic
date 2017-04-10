<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use moonland\tinymce\TinyMCE;
use kartik\widgets\FileInput;
?>

<div class="ourpartner-form">
    <div class="col-lg-4">
        <h2>Модуль Наши Партнеры</h2>
        <p>
            Партнёр месяца может выбран только один.
            Для Партнёра месяца загружайте, пожалуйста, изображения размером 295 х 618 пиксилей.

        </p>
    </div>
    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal col-lg-8', 'enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'title')->textInput(['maxlength' => 255])->hint('Введите название партнера')->label(true); ?>
    <?= $form->field($model, 'url')->textInput(['maxlength' => 255])->hint('Например, http://ya.ru')->label(true); ?>
    <?= $form->field($model, 'main_partner')->checkbox()->label(true); ?>

<?= $form->field($model, 'imageFile')->fileInput()->label("Изображение");  ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

