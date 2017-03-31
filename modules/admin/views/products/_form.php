<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use moonland\tinymce\TinyMCE;
use kartik\widgets\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'meta_keywords')->textarea(['rows' => 3]) ?>
    <?= $form->field($model, 'meta_description')->textarea(['rows' => 3]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 7]) ?>
    <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>

<!---->
<!--    --><?// echo TinyMCE::widget(['name' => 'description']);
//
//    $form->field($model, 'description')->widget(TinyMCE::className());
//    ?>

    <?= $form->field($model, 'cashback')->textInput(['maxlength' => true]) ?>

    <?php $casino_items = $model->getCasinoList();

    $params = [
        'prompt' => 'Выберите казино'
    ];
    echo $form->field($model, 'casino_id')->dropDownList($casino_items,$params);?>



    <?= $form->field($model, 'imageFile')->fileInput() ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
