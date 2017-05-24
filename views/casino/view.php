<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use  app\models\City;
use evgeniyrru\yii2slick\Slick;
use  yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $model app\models\Casino */

$this->title = $model->title;
$this->registerCssFile('/css/casino.css');
//$this->registerJSFile('/js/account.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="clearfix"></div>
<div class="container">
    <div class="casino-view">
    <div class="row">

<div class="casino_title col-lg-12">
    <h1><?= $model->title ?></h1>  <span class="city"><?= $model->getCityName(); ?></span>

</div>


</div>
        <? //ToDo: Сделать слайдер (backend + frontend) ?>
        <div class="slider_block_casino_row row">

            <div class="slider_block_casino col-lg-11">
                <?
                $sliders_img_casino =["<img src='/image/casino_sliders/img1.png'/>","<img src='/image/casino_sliders/img2.png'/>" ,"<img src='/image/casino_sliders/img3.png'/>","<img src='/image/casino_sliders/img1.png'/>"];

//                foreach ( $model->products as $product) {
//                    if ($product->img_url != null) {
//                        $img_url = Yii::getAlias('@web') . '/' . Yii::getAlias('@img_path') . '/' . $product->img_url;
//                    }
//                    else{
//                        $img_url= '/image/noimg.jpg';
//                    }
//                    array_push($sliders_img_product,   '<a href="product/view?id='.$product->id.'">'.Html::img($img_url).'</a><span class="casino_title_product">'.$model->title.'</span><span class="city_title_product">'.$model->getCityName().'</span><br><a href="product/view?id='.$product->id.'"><span class="product_title">'.$product->title.'</span></a>');
//
//                }

                echo Slick::widget([

                    // HTML tag for container. Div is default.
                    'itemContainer' => 'div',

                    // HTML attributes for widget container
                    'containerOptions' => ['class' => 'silder_casino'],

                    // Items for carousel. Empty array not allowed, exception will be throw, if empty
                    'items' => $sliders_img_casino,

                    // HTML attribute for every carousel item
                    'itemOptions' => ['class' => 'cat-image'],

                    // settings for js plugin
                    // @see http://kenwheeler.github.io/slick/#settings
                    'clientOptions' => [
                        'autoplay' => true,
                        'dots'     => false,
                        'infinite' => true,
                        'slidesToShow' => 3,
                        'slidesToScroll' => 3,
                        'responsive' => [
                            [
                                'breakpoint' => 1400,
                                'settings' => [
                                    'slidesToShow' => 3,
                                    'slidesToScroll' => 3,
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

<!--                --><?php //if ($model->img_url != null) {
//                ?>
<!--                <img  src="--><?//= Yii::getAlias('@web') . '/' . Yii::getAlias('@img_path') . '/' . $model->img_url; ?><!--">-->
<!--            </div>-->
<!--            --><?php
//            }
//            else {
//            ?>
<!--            <img src="/image/noimg.jpg" ></div>-->
<!--        --><?//
//        }
//        ?>
            </div>
        </div>


        <div class="content_block row">
            <div class="content col-lg-7">
<?= $model->description ?>
            </div>

            <div class="features col-lg-4">
              <div><span class="title_features">  ИГРЫ</span> <p>Блэк Джек, Игровые автоматы, Американская рулетка, Техасский покер</p></div>
                <hr>
                <div><span class="title_features">  ОСОБЕННОСТИ</span> <p>VIP-зал, Ресторан</p></div>
                <hr>
                <div><span class="title_features">   РАЗВЛЕЧЕНИЯ </span><p>Бильярд, Шоу-программа</p></div>
                <hr>
                        <div><span class="title_features" >  ПАРКОВКА</span> <p>Есть</p></div>
                <hr>
                            <div><span class="title_features"> ВРЕМЯ РАБОТЫ</span> <p>Круглосуточно</p></div>
                <hr>
                                <div><span class="title_features">  КОНТАКТЫ</span> <p>Республика Беларусь, г. Минск, ул. Кирова, 8/3
                                        Тел: + 375 17 321 20 22

                                       </p></div>
                <hr>
                                    <div><span class="title_features">  САЙТ</span> <p><b> shangrila.by</b></p></div>
            </div>
        </div>

        <div class="row">
            <div class="bonus_plan_content col-lg-12">
<h2>Бонус-планы казино</h2>
                <div class="bonus_plan col-lg-11">
                    <?
                    $sliders_img_product =[];

                    foreach ( $model->products as $product) {
                    if ($product->img_url != null) {
                        $img_url = Yii::getAlias('@web') . '/' . Yii::getAlias('@img_path') . '/' . $product->img_url;
                    }
                    else{
                        $img_url= '/image/noimg.jpg';
                    }
                        array_push($sliders_img_product,   '<a href="product/view?id='.$product->id.'">'.Html::img($img_url).'</a><span class="casino_title_product">'.$model->title.'</span><span class="city_title_product">'.$model->getCityName().'</span><br><a href="product/view?id='.$product->id.'"><span class="product_title">'.$product->title.'</span></a>');

                    }

                    echo Slick::widget([

                        // HTML tag for container. Div is default.
                        'itemContainer' => 'div',

                        // HTML attributes for widget container
                        'containerOptions' => ['class' => 'silder_product'],

                        // Items for carousel. Empty array not allowed, exception will be throw, if empty
                        'items' => $sliders_img_product,

                        // HTML attribute for every carousel item
                        'itemOptions' => ['class' => 'cat-image'],

                        // settings for js plugin
                        // @see http://kenwheeler.github.io/slick/#settings
                        'clientOptions' => [
                            'autoplay' => true,
                            'dots'     => false,
                            'infinite' => true,
                            'slidesToShow' => 3,
                            'slidesToScroll' => 3,
                            'responsive' => [
                                [
                                    'breakpoint' => 1400,
                                    'settings' => [
                                        'slidesToShow' => 3,
                                        'slidesToScroll' => 3,
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
        </div>
    </div>
</div>
