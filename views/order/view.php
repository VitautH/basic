<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = "Заказ №".$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Заказ №'. $model->id;
?>






<div class="order-view">
    <div class="container">
<div class="row">
    <h1><?= Html::encode($this->title) ?></h1>
    </div>
<div class="row">
    <table>
        <tbody>
        <tr>
            <td>
               Услуга
            </td>
            <td>
        <?=$model->product->title; ?>
            </td>
        </tr>
        <tr>
            <td>
                Стоимость
            </td>
            <td>
                <?=$model->amount; ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php $form = ActiveForm::begin([
                    'action' =>['order/payment'],
                    'id' => 'order-form',
                    'options' => ['class' => 'form-horizontal'],
                ]); ?>

                <? //ToDo: Заменить название атрибутов для платёжного терминала?>
                <input type="hidden" name="amount"  value="<?=$model->amount;?>" id=""/>
                <input type="hidden" name="id"  value="<?=$model->id;?>" id=""/>
                <input type="hidden" name="title"  value="<?=$model->product->title;?>" id=""/>
                <input type="hidden" name="status"  value="1" id=""/>

                <?= Html::submitButton(Yii::t('app', 'Оплатить'), ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            </td>

        </tr>
        </tbody>
    </table>
</div>

    </div>

</div>
