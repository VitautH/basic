<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\widgets\FileInput;
use app\modules\admin\models\Casino;
/* @var $this yii\web\View */
/* @var $model app\models\Casino */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="casino-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(TinyMce::className(), [
        'options' => ['rows' => 8],
        'language' => 'ru',
        'clientOptions' => [
            'file_browser_callback' => new yii\web\JsExpression("function(field_name, url, type, win) {
            window.open('".yii\helpers\Url::to(['/imagemanager/manager', 'view-mode'=>'iframe', 'select-type'=>'tinymce'])."&tag_name='+field_name,'','width=800,height=540 ,toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no');
        }"),
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste image"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]);?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>


    <?php $city_items = $model->getCityList();

    $params = [
        'prompt' => 'Выберите город'
    ];

    echo $form->field($model, 'city_id')->dropDownList($city_items,$params);?>

    <?= $form->field($model, 'contacts')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'logo_id')->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [

            'aspectRatio' => (1/1), //set the aspect ratio
            'showPreview' => true, //false to hide the preview
            'showDeletePickedImageConfirm' => false, //on true show warning before detach image
        ]);
        ?>

    <?= $form->field($model, 'games')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'features')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entertainment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parking')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'working_hours')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>