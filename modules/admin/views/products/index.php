<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Products', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'casinoName',
            'cost',
            'description:ntext',
            'cashback',
            [
                'attribute' => 'img_url',
                'format' => 'html',
                'value' =>function ($data) {
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
