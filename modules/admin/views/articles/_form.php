<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use moonland\tinymce\TinyMCE;
/* @var $this yii\web\View */
/* @var $model app\models\base\Articles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textarea(['maxlength' => true]) ?>


    <label class="control-label" for="articles-meta_description">Бриф</label>
    <? echo TinyMCE::widget(['name' => 'text-content']);

    $form->field($model, 'brief')->widget(TinyMCE::className());
    ?>
    <label class="control-label" for="articles-meta_description">Текст новости</label>
    <? echo TinyMCE::widget(['name' => 'text-content']);

    $form->field($model, 'text')->widget(TinyMCE::className());
    ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
