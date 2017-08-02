<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Casino */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Casinos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="casino-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'meta_keywords',
            'meta_description',
            ['attribute'=>'description',
                'format'=>'html',
                'value'=> function($data){
                    return Html::decode($data->description);
                }
            ],
            'city_id',
            'contacts',
            'phone',
            'games',
            'features',
            'entertainment',
            'parking',
            'working_hours',
            'site',
            [
                'attribute' => 'logo_id',
               'format' => 'html',
                'value' => function ($data) {
                   if ($data->logo_id != null) {
                        return Html::img(Yii::$app->imagemanager->getImagePath($data->logo_id, '100', '100','outbound'));
                    } else {
                       return "N/A";
                    }
                },
            ]
        ],

    ]) ?>

</div>

