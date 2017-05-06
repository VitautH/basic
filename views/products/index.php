<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile('/css/products.css');
$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
$this->registerJsFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
$this->title = 'Продукты';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="clearfix"></div>
<div class="products-index">
    <div class="container">



        <div class="row">
            <div class="bonus_plan_left_sidebar_block col-lg-4">
                <h3>
                    КАК ПОЛУЧИТЬ БОНУС ПЛАН?
                </h3>
            </div>
            <div class="bonus_plan_steps col-lg-8">


            </div>

        </div>
    </div>


    <div class="container">
        <article>
        <div class="row">

            <div class="filter_left_sidebar col-lg-4">

            </div>
            <div class="products col-lg-8">


<?php foreach ($model as $product):
    ?>


                    <div class="item">


                        <div class="image">

                            <img src="<?= Yii::getAlias('@web') . '/' . Yii::getAlias('@img_path') . '/' .$product->img_url;?>" width="100%" height="350px"></div>

                        <div class="card">
                            <h3><?=$product->casino->title;?></h3>


                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#description_<?=$product->id?>" aria-controls="description_<?=$product->id?>" role="tab" data-toggle="tab">Описание</a></li>
                                <li role="presentation"><a href="#cashback_<?=$product->id?>" aria-controls="cashback_<?=$product->id?>" role="tab" data-toggle="tab">Кэшбэк</a></li>
                                <li role="presentation"><a href="#services_<?=$product->id?>" aria-controls="services_<?=$product->id?>" role="tab" data-toggle="tab">Включенные услуги</a></li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active description" id="description_<?=$product->id?>"><p><?=$product->description;?></p></div>
                                <div role="tabpanel" class="tab-pane cashback"  id="cashback_<?=$product->id?>"><?=$product->cashback?></div>
                                <div role="tabpanel" class="tab-pane services"  id="services_<?=$product->id?>">.3..</div>

                            </div>
                            <span class="product_title"> <?= $product->title?></span>
                            <?php //ToDo: Registration or Order ?>
                            <?php  $user = new User;
                            if ($this->context->getRole()!==$user::GUEST) {

                                ?>
                                <a class="booking" href="/products/view?id=<?=$product->id;?>"?>ЗАБРОНИРОВАТЬ</a>
                                <?php
                            }
                            else{
                                ?>
                                <a class="singup" href="/singup/"?>РЕГИСТРАЦИЯ</a>
                                <?php
                            };

                            ?>




                        </div>


                    </div>


                <?php
                endforeach;
                ?>


            </div>

        </div>
        </article>
    </div>


</div>

