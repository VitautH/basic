<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\Size;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;

$this->title = 'Контакты';
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
$this->registerCssFile('/css/contact.css');
?>
<div class="clearfix"></div>

    <div class="container">
        <div class="contact">
        <div class="row">
            <div class="col-lg-12">
                <h1><?=$this->title; ?></h1>
            </div>
        </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="maps">

            <?
            $coord = new LatLng(['lat' => 53.9272585, 'lng' =>  27.6671514]);
            $map = new Map([
                'center' => $coord,
                'zoom' => 14,
                'width'=>'100%',
                  'height'=>'594'
            ]);
            // Lets configure the polyline that renders the direction
            $polylineOptions = new PolylineOptions([
                'strokeColor' => '#FFAA00',
                'draggable' => true
            ]);

            $waypoints = [
                new DirectionsWayPoint(['location' => $coord])
            ];

            // Lets add a marker now
            $marker = new Marker([
                'position' => $coord,
                'title' => 'TIME GAME',
            ]);
            $map->addOverlay($marker);

            echo $map->display();



            ?>
                        <div class="contact_block">
                            <img src="/image/mini_logo.png"/>
                            <ul>
                                <li  class="addres"><span class="glyphicon glyphicon-map-marker"></span>22040, Республика Беларусь, г. Минск, ул. Сурганова, 2А, ОФ. 3</li>
                                <li class="phone"><span class="glyphicon glyphicon-earphone"></span> +37529-755-55-55</li>
                                <li class="email"><span class="glyphicon glyphicon-envelope"></span> info@timegame.by</li>
                                <li class="skype"><i class="fa fa-skype"></i>timegame</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


