<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Casinos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="casino-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Casino', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'cityName',
            ['attribute'=>'description',
                'format'=>'html',
                'value'=> function($data){
                    return \yii\helpers\StringHelper::truncate(Html::decode($data->description), '300');
                }
            ],
            [
             'attribute' => 'gallery',
                'format' => 'html',
                'value'=> function($data){
    return Html::a('Перейти', '/admin/casino/gallery?id='.$data->id);
                }
            ],

            [
                'attribute' => 'logo_id',
                'format' => 'html',
                'value' =>function ($data) {
                    if ($data->logo_id != null) {
                        return Html::img(Yii::$app->imagemanager->getImagePath($data->logo_id, '100', '50',  'inset'));
                    } else {
                        return "N/A";
                    }
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
