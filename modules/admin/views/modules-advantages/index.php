<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Приемущества';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modules-advantages-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'content',
            'attribute'=>[
                'label'=>'Действия',
                'format'=>'html',

                'value'=>function($data){
                    return Html::a('Изменить', '/admin/modules-advantages/update?id='.$data->id);
                }
            ]
        ],
    ]); ?>
</div>
