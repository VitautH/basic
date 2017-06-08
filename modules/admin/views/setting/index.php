<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'params',
            'value',
            'attribute'=>[
                    'label'=>'Действия',
                'format'=>'html',

                'value'=>function($data){
        return Html::a('Изменить', '/admin/setting/update?id='.$data->id);
                }
            ]


        ],
    ]); ?>
</div>
