<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\widgets\FileInput;
use app\models\Services;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'meta_keywords')->textarea(['rows' => 3]) ?>
    <?= $form->field($model, 'meta_description')->textarea(['rows' => 3]) ?>

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
    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'cashback')->textInput(['maxlength' => true]) ?>

    <?php $casino_items = $model->getCasinoList();

    $params = [
        'prompt' => 'Выберите казино'
    ];
    echo $form->field($model, 'casino_id')->dropDownList($casino_items,$params);?>


    <?php
    $data= array();
    $model->service_id = array();
    foreach (Services::find()->all() as $service):

    $data[$service->id]=$service->name;
        if(!empty($model->hasService($service->id))){
            array_push($model->service_id,$service->id );

        }
    endforeach;


    echo $form->field($model, 'service_id')->widget(Select2::classname(), [

        'data' => $data,
        'options' => ['placeholder' => 'Выбор услуги ...', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
    ])->label('Услуги');

?>
<?=Html::a('Добавить услугу ','/admin/service/create');?>
    <?=$form->field($model, 'logo_id')->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [

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
