<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Casino;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Галерея ';

$id = Yii::$app->request->get('id');
?>
<div class="img-casino-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Загрузить изображение', ['/admin/casino/gallery-add?id='.$id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

    ['attribute'=>'casino_id',
    'format'=> 'html',
    'value'=> function ($data){
        return $data->casino->title;
    }
    ],
            ['attribute'=>'img_url',
             'format'=> 'html',
                'value'=> function ($data){
        return Html::img(Yii::$app->imagemanager->getImagePath($data->img_url, '200', '150',  'inset'));
                }
                ],
'columns'=>[
    'class' => \yii\grid\ActionColumn::className(),
    'buttons'=>[
        'update'=>function ($url, $model) {
            $customurl=Yii::$app->getUrlManager()->createUrl(['/admin/casino/gallery-update','id'=>$model['id']]); //$model->id для AR
            return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $customurl,
                ['title' => Yii::t('yii', 'Обновить'), 'data-pjax' => '0']);
        },
        'delete'=>function ($url, $model) {
            $customurl=Yii::$app->getUrlManager()->createUrl(['/admin/casino/gallery-delete','id'=>$model['id']]); //$model->id для AR
            return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $customurl,
                ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => '0']);
        }
    ],
    'template'=>'{update} {delete}'
],

        ],
    ]); ?>
</div>
