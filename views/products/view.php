<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'price',
            'description',
            'cashback',
            'casino_id',
        ],
    ]);


    $user = new User;
    if ($this->context->getRole()!==$user::GUEST) { ?>
        <?php
        $form = ActiveForm::begin([
            'action' =>['order/create'],
            'id' => 'order-form',
            'options' => ['class' => 'form-horizontal'],
        ]) ?>

     <?= $form->field($model, 'id')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'price')->hiddenInput()->label(false); ?>
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('КУПИТЬ', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    <?php }
    else {
     echo  HTML::a('Регистрация', ['/singup']);
    }
    ?>
</div>
