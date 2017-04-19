<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Купоны';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="casino-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [


            'id',
            [
                'label' => 'Название',
                'format' => 'raw',
                'value' =>'title',
            ],
            [
                'label' => 'Категория',
                'format' => 'raw',
                'value' =>'CategoryName',
                ],
            [
                'label' => 'Дата публикации',
                'format' => 'raw',
                'value' => 'date_published',
            ],
            [
                'label' => 'Дата создания',
                'format' => 'raw',
                'value' => 'date_created',
            ],
            [
                'attribute' => 'img_url',
                'format' => 'html',
                'value' => function ($data) {
                    if ($data->img_url != null) {
                        return Html::img(Yii::getAlias('@web') . '/' . Yii::getAlias('@img_path') . '/' . $data->img_url, [
                            'alt' => 'yii2 - картинка в gridview',
                            'style' => 'width:100px;'
                        ]);
                    } else {
                        return "N/A";
                    }
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
