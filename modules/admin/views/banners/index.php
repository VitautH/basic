<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Баннер';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Html::a('Добавить баннер', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'url',
            [
                'label' => 'Логотип',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->img_url != null) {
                        return Html::img(Yii::getAlias('@web') . '/' . Yii::getAlias('@img_path') . '/' . $data->img_url, [
                            'alt' => 'yii2 - картинка в gridview',
                            'style' => 'width:100px;'
                        ]);
                    } else {
                        return Html::img(Yii::getAlias('@web') . '/image/noimg.jpg',
                            ['width' => '100px'
                            ]);
                    }
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>