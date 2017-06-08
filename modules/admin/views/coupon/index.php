<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Coupon;
use app\models\User;
use app\models\Order;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Купоны';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'Пользователь',
                'format'=>'html',
           'value'=> function($data){
       return Coupon::getCouponUserLink($data->id);




                }
            ],
            'coupon',
           [
            'attribute'=>'Статус купона',
               'format'=>'raw',
               'value'=>function($data){
        switch ($data->status){
            case Coupon::UNUSED :
                return 'Не погашен';
                break;
            case Coupon::USED :
                return 'Погашен';
                break;
        }
               }
           ],
            [
                'attribute'=>'Стоимость',
                'format'=>'raw',
                'value'=>function($data){
                   return Coupon::getCouponPrice($data->id). ' BYN';
                }
            ],

            [
                'attribute'=>'Бонус-план',
                'format'=>'raw',
                'value'=>function($data){
                    return Coupon::getCouponOrder($data->id);
                }
            ],
        ],
    ]); ?>
</div>
