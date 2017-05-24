<?php

/* @var $this yii\web\View */

use  yii\app;
use evgeniyrru\yii2slick\Slick;
use  yii\web\JsExpression;
use yii\helpers\Html;
$this->title = 'Casino';
$this->registerJSFile('/js/advantage.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="container">
    <div class="row">
        <div class="offer">


            <div class="col-lg-6">
                <span class="title_1">Хотите воспользоваться услугой?</span>
            </div>

            <div class="col-lg-5">
                <div class="arrow_box"><a href="/products">Забронировать сейчас</a></div>
            </div>
        </div>
    </div>
</div>
<article>
<div class="container">
<div class="row">
        <div class="banner_left col-lg-3">
            <?php if ($banner !== null) {
                ?>
                <a href="<?= $banner->url; ?>"> <img width="295" height="618"
                                                     src="<?= Yii::getAlias('@web') . '/' . Yii::getAlias('@img_path') . "/" . $banner->img_url ?>"/>
                </a>
                <?php
            }
            ?>
        </div>

<div class="content col-lg-9">
    <h1>новости</h1>


    <? foreach ($articles as $key=>$article) : ?>
        <div class="<?= ($key== 2) ? 'end':'' ?> news col-lg-4">
            <h2>
                <?= $article->title?>
            </h2>
            <p>
                <?= $article->brief?>
            </p>
            <span class="more">     <a href="articles/view?id=<?= $article->id;?>"> подробнее </a> </span>
        </div>
    <? endforeach; ?>

</div>
<div class="partner_block col-lg-9">
<h2>НАШИ ПАРТНЁРЫ</h2>


   <?
   $sliders_img =[];

   foreach ($casinos_slider_img as  $key=>$casino) {
$img_url = Yii::getAlias('@web') . '/' . Yii::getAlias('@img_path') . '/' . $casino->img_url;
       array_push($sliders_img,   '<a href="casino/view?id='.$casino->id.'">'.Html::img($img_url, $options = ['style' => [
               'width' => '118px',
               'height' => '121px',
           ],]).'</a>');
   }

            echo Slick::widget([

                // HTML tag for container. Div is default.
                'itemContainer' => 'div',

                // HTML attributes for widget container
                'containerOptions' => ['class' => 'responsive silder_partner'],

                // Items for carousel. Empty array not allowed, exception will be throw, if empty
                'items' => $sliders_img,

                // HTML attribute for every carousel item
                'itemOptions' => ['class' => 'cat-image'],

                // settings for js plugin
                // @see http://kenwheeler.github.io/slick/#settings
                'clientOptions' => [
                    'autoplay' => false,
                    'dots'     => false,
                    'infinite' => true,
                    'slidesToShow' => 4,
                    'slidesToScroll' => 1,
                    'centerMode'=> false,
  'variableWidth'=> false,
                    'draggable'=>false,
                    'responsive' => [
                        [
                            'breakpoint' => 768,
                            'settings' => [
                                'slidesToShow' => 2,
                                'slidesToScroll' => 2,
                                'infinite' => true,
                                'autoplay' => false,
                                'dots' => false,
                            ],
                        ],
                       [ 'breakpoint' => 480,
                        'settings' => 'unslick',
                           ],
                            ],
                    // note, that for params passing function you should use JsExpression object
                    'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
                ],

            ]);

            ?>




</div>
    </div>
<div class="row">
    <div class="bonus_plan_left_sidebar_block col-lg-4">
<h3>
    ПОПУЛЯРНЫЕ БОНУС-ПЛАНЫ
</h3>
    </div>
    <div class="bonus_plan_steps col-lg-8">
        <?= $this->render('_popular', ['products' => $products]) ?>
    </div>
</div>
</div>
</article>
<div class="container bottom">
    <div class="row">
        <div class="left_block col-lg-4">
<h3>
    ПРЕИМУЩЕСТВА РАННЕГО БРОНИРОВАНИЯ
</h3>
        </div>
        <div class="advantages_block col-lg-5">
<div class="block_1 active  col-lg-12" id="advantage_1">
<div class="icon col-lg-2"></div>
    <div class="col-lg-8"><h3>ПОЛУЧАЕТЕ НА 10% БОЛЬШЕ</h3>
        <p>Среди них широкий ассортимент, квалифицированный персонал, привлекательные условия.</p>
    </div>
            </div>
            <div class="block_2 col-lg-12" id="advantage_2" data-toggle="2">
                <div class="icon col-lg-2"></div>
                <div class="col-lg-8"><h3>ВЫСОКОЕ КАЧЕСТВО УСЛУГ</h3>
                    <p>
                        Среди них широкий ассортимент, квалифицированный персонал, привлекательные условия.
                    </p>
                </div>

            </div>
            <div class="block_3 col-lg-12" id="advantage_3">
                <div class="icon col-lg-2"></div>
                <div class="col-lg-8"><h3>ЭКОНОМИТЕ СВОЕ ВРЕМЯ</h3><p>
                        Среди них широкий ассортимент, квалифицированный персонал, привлекательные условия.
                    </p></div>
            </div>
        </div>
        <div class="right_block col-lg-3">
            <h3>
                ПОЛУЧАЕТЕ НА 10% БОЛЬШЕ
            </h3>
            <p>
                Среди них широкий ассортимент, квалифицированный персонал, привлекательные условия
            </p>

        </div>


    </div>
</div>