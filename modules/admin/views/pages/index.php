<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
'title',
            [
                'label' => 'Контент',
                'format' => 'html',
                'value' => function ($data) {
               $content = \yii\helpers\StringHelper::truncate($data->content,150,'...');
        return Html::decode($content);

                },
            ],

['label'=>'Меню',
    'format'=>'raw',
    'value'=>function ($data){
        return $data->getMenuName();
    }
    ],
            'date_created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
