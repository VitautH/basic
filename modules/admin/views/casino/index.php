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

            'id',
            'title',
            'cityName',
            'address_street',
            'phone',
            [
                'attribute' => 'Images',
                'format' => 'html',
                'value' => function ($data) {
if($data['Image']['img_url'] !== null) {
    return Html::img(Yii::getAlias('@web') . '/' . Yii::getAlias('@img_path') . '/' . $data['Image']['img_url'],
        ['width' => '200px']);
}
else {
    return Html::img(Yii::getAlias('@web') . '/image/noimg.jpg',
        ['width' => '100px']);
}
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
