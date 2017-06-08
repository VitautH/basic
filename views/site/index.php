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


            <div class="col-lg-6 col-sm-12">
                <span class="title_1">Хотите воспользоваться услугой?</span>
            </div>

            <div class="col-lg-5 col-sm-12">
                <div class="arrow_box"><a href="/products">Забронировать сейчас</a></div>
            </div>
        </div>
    </div>
</div>
<article>
<div class="container">
<div class="row">
        <div class="banner_left col-lg-3 col-xs-12 col-sm-5">
            <?php if ($banner !== null) {
                ?>
                <a href="<?= $banner->url; ?>"> <img width="295" height="618"
                                                     src="<?= Yii::getAlias('@web') . '/' . Yii::getAlias('@img_path') . "/" . $banner->img_url ?>"/>
                </a>
                <?php
            }
            ?>
        </div>

<div class="content col-lg-9 col-xs-12 col-sm-7">
    <h1>новости</h1>


    <? foreach ($articles as $key=>$article) : ?>
        <div class="<?= ($key== 2) ? 'end':'' ?> news col-lg-4 col-xs-12">
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
<div class="partner_block col-lg-9 col-xs-12 col-sm-12">
<h2>НАШИ ПАРТНЁРЫ</h2>


   <?
   $sliders_img =[];

   foreach ($casinos_slider_img as  $key=>$casino) {
$img_url = Yii::$app->imagemanager->getImagePath($casino->logo_id, '118', '121');
       array_push($sliders_img,   '<a href="casino/view?id='.$casino->id.'">'.Html::img($img_url, $options = ['style' => [
               'width' => '118px',
               'height' => '121px',
               'border-radius'=>'120px'
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
                            'breakpoint' => 1224,
                            'settings' => [
                                'slidesToShow' => 3,
                                'slidesToScroll' => 1,
                                'infinite' => true,
                                'autoplay' => false,
                                'dots' => false,
                            ],
                        ],
                       [ 'breakpoint' => 600,
                           'settings' => [
                               'slidesToShow' => 1,
                               'slidesToScroll' => 1,
                               'infinite' => true,
                               'autoplay' => false,
                               'dots' => false,
                           ],
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
    <div class="bonus_plan_left_sidebar_block col-lg-4 col-xs-12">
<h3>
    ПОПУЛЯРНЫЕ БОНУС-ПЛАНЫ
</h3>
    </div>
    <div class="bonus_plan_steps col-lg-8 col-xs-12 col-sm-12">
        <?= $this->render('_popular', ['products' => $products]) ?>
    </div>
</div>
</div>
</article>
<div class="container bottom">
    <div class="row">
        <div class="left_block col-lg-4 col-xs-12">
<h3>
    ПРЕИМУЩЕСТВА РАННЕГО БРОНИРОВАНИЯ
</h3>

        </div>
        <div class="advantages_block col-lg-5 col-xs-12 col-sm-7">

            <?php
            foreach($this->context->advantages as $advantage):
                ?>
                <div class="block_<?=$advantage['id']; if($advantage['id']==1){echo' active';} ?> col-lg-12  col-xs-12"  <? if($advantage['id']==2){echo'data-toggle="2"';} ?>id="advantage_<?=$advantage['id']?>">
                    <div class="icon col-lg-2 col-xs-2"></div>
                    <div class="col-lg-8 col-xs-8"><h3><?=$advantage['title']?></h3>
                        <p><?=$advantage['content']?></p>
                    </div>
                </div>

            <?
            endforeach;
            ?>

        </div>
        <div class="right_block col-lg-3 col-xs-12 col-sm-5">
            <h3>
               <?=$this->context->advantages[0]['title']?>
            </h3>
            <p>
                <?=$this->context->advantages[0]['content']?>
            </p>

        </div>


    </div>
</div>