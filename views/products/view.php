<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Services;

use app\models\Products;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Products */
$this->registerCssFile('/css/product-view.css');
$this->title = $model->title;

$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clearfix"></div>
<div class="products-view">
<div class="container">

    <div class="row">
        <div class="col-lg-8">

            <div class="title_block"> <a href="/casino/view?id=<?=$model->casino->id;?>"><?= $model->casino->title;?></a></h2> <span class="city"><?= $model->casino->city->name;?></span></div>
            <div class="clearfix"></div>

            <div class="img">    <?php if ($model->img_url != null) {
                ?>
                <img width="100%" height="560px" src="<?= Yii::getAlias('@web') . '/' . Yii::getAlias('@img_path') . '/' . $model->img_url; ?>">
            </div>
            <?php
            }
            else {
                ?>
            <img src="/image/noimg.jpg" width="100%" height="560px"></div>
                <?
            }
            ?>
            <div class="clearfix"></div>
            <div class="description">
                <span class="title_description">Описание:</span>
<p><?= $model->description;?></p>
            </div>
            <div class="cashback">
                <span class="title_cashback">Кэшбэк:</span>
<?= $model->cashback;?> BYN
            </div>
            <div class="included_service">
                <span class="title_included_service">Включенные услуги:</span>
                <ul>
                <?php foreach ($model->productsServices as $product_service):
                    $id = $product_service->id_service;
                ?>
                <li><?=Services::findOne($id)->name;?></li>
                <?


             endforeach;


                ?>
                </ul>
            </div>


        </div>
        <div class="col-lg-4">
            <div class="price_block"> <span class="price"><?=  $model->price;?></span> BYN</div>
            <div class="clearfix"></div>
            <div class="booking_block">
                <?php
                $user = new User;
                    if ($this->context->getRole()!==$user::GUEST) {
                       echo Html::submitButton('ЗАБРОНИРОВАТЬ', ['class' => 'booking', 'id'=>'booking']);
                   }
                else {
                    echo  HTML::a('ЗАБРОНИРОВАТЬ',  [Yii::$app->request->url.'#'], ['class' => 'singup_form_click']);
                }
                ?>
            </div>


        </div>
    </div>
</div>

<?php  if ($this->context->getRole()!==$user::GUEST):
?>
<div class="continue_to_pay_modal">
    <div class="close" id="close_modal_continue_to_pay">
        <span>x</span>
    </div>
    <div class="content">
                                <p class="user_name">
Уважаемый  <?= $this->context->getUserName() ?> !
                                </p>

        <p class="tip">
            Вы сейчас будите перенаправлены в платёжный терминал
        </p>
        <?
        $form = ActiveForm::begin([
            'action' =>['order/create'],
            'id' => 'order-form',
            'options' => ['class' => 'form-horizontal'],
        ]) ?>

        <input type="hidden" id="products-id" class="form-control" name="Products[id]" value="<?= $model->id;?>">
        <input type="hidden" id="products-price" class="form-control" name="Products[price]" value="<?= $model->price;?>">

        <?= Html::submitButton('ПРОДОЛЖИТЬ', ['class' => 'continue_to_pay', 'id'=>'continue_to_pay']) ?>


        <?php ActiveForm::end() ?>
    </div>
</div>
<?
endif;
?>
</div>
