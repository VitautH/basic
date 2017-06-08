<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImgCasino */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="img-products-form">

    <?php $form = ActiveForm::begin(); ?>
    <?=$form->field($model, 'id')->hiddenInput(['value'=> $id])->label(false)?>
    <?=$form->field($model, 'product_id')->hiddenInput(['value'=> $model->product_id])->label(false)?>
    <?=$form->field($model, 'img_url')->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [

        'aspectRatio' => (1/1), //set the aspect ratio
        'showPreview' => true, //false to hide the preview
        'showDeletePickedImageConfirm' => false, //on true show warning before detach image
    ]);
    ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
