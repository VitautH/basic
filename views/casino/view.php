<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use  app\models\City;
use app\models\ImgCasino;
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

<div class="casino_title col-lg-12 col-xs-12">
    <h1><?= $model->title ?></h1>  <span class="city"><?= $model->getCityName(); ?></span>

</div>


</div>
        <? //ToDo: Сделать слайдер (backend + frontend) ?>
        <div class="slider_block_casino_row row">

            <div class="slider_block_casino col-lg-11 col-xs-12">
                <?

                $sliders_img_casino= array();
               $slider_img_casino_array =  ImgCasino::find()->where([ '=', 'casino_id', $model->id ])->asArray()->all();

                foreach ( $slider_img_casino_array as $img_casino) {


                   array_push($sliders_img_casino,   Html::img(Yii::$app->imagemanager->getImagePath($img_casino['img_url'], '345', '348')));

                }


if (!empty($sliders_img_casino)):


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
                            [
                                'breakpoint' => 600,
                                'settings' => [
                                    'slidesToShow' => 2,
                                    'slidesToScroll' => 1,
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
endif;
                ?>

            </div>
        </div>


        <div class="content_block row">
            <div class="content col-lg-7 col-xs-12">
<?= $model->description ?>
            </div>

            <div class="features col-lg-4 col-xs-12">
                <table class="responsive">
                    <tbody>
                    <tr>
                        <td class="cell_features">
                            <span class="title_features">ИГРЫ</span>
                        </td>
                        <td>
                            <p><?=$model->games?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell_features">
                            <span class="title_features">ОСОБЕННОСТИ</span>
                        </td>
                        <td>
                            <p><?=$model->features?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell_features">
                            <span class="title_features">РАЗВЛЕЧЕНИЯ</span>
                        </td>
                        <td>
                            <p><?=$model->entertainment?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell_features">
                            <span class="title_features">ПАРКОВКА</span>
                        </td>
                        <td>
                            <p><?=$model->parking?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell_features">
                            <span class="title_features"> ВРЕМЯ РАБОТЫ</span>
                        </td>
                        <td>
                            <p><?=$model->working_hours?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell_features">
                            <span class="title_features">КОНТАКТЫ</span>
                        </td>
                        <td>
                            <p><?=$model->contacts?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="cell_features">
                            <span class="title_features">САЙТ</span>
                        </td>
                        <td>
                            <p><b><?=$model->site?></b></p>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="row">
            <div class="bonus_plan_content col-lg-12 col-xs-12">
<h2>Бонус-планы казино</h2>
                <div class="bonus_plan col-lg-11 col-xs-12">
                    <?
                    $sliders_img_product =[];

                    foreach ( $model->products as $product) {
                    if ($product->logo_id != null) {
                        $img_url = Yii::$app->imagemanager->getImagePath($product->logo_id, '270', '270','inset');
                        array_push($sliders_img_product,   '<a href="/product/view?id='.$product->id.'">'.Html::img($img_url).'</a><a href="/product/view?id='.$product->id.'"><span class="casino_title_product">'.$product->title.'</span></a><span class="city_title_product">'.$model->getCityName().'</span><br><span class="product_title">'.$model->title.'</span>');

                    }


                    }
if (!empty($sliders_img_product)):
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
                            'slidesToScroll' => 2,
                            'responsive' => [
                                [
                                    'breakpoint' => 1400,
                                    'settings' => [
                                        'slidesToShow' => 3,
                                        'slidesToScroll' => 2,
                                        'infinite' => true,
                                        'autoplay' => false,
                                        'dots' => false,
                                    ],
                                  [  'breakpoint' => 600,
                                    'settings' => [
                                        'slidesToShow' => 2,
                                        'slidesToScroll' => 1,
                                        'infinite' => true,
                                        'autoplay' => false,
                                        'dots' => false,
                                    ],
],

                                ],
//                                [
//                                    'breakpoint' => 600,
//                                    'settings' => [
//                                        'slidesToShow' => 1,
//                                        'slidesToScroll' => 1,
//                                        'infinite' => true,
//                                        'autoplay' => false,
//                                        'dots' => false,
//                                    ],
//                                ],
//                                [ 'breakpoint' => 600,
//                                    'settings' => 'unslick',
//                                ],
                            ],
                            // note, that for params passing function you should use JsExpression object
                            'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
                        ],

                    ]);
endif;
                    ?>




                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /*Responsive max 600 px */
    @media only screen and (max-width: 600px) {
        .container{
            padding: 0!important;
        }
    }
</style>