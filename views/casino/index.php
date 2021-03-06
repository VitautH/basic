<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = _t('Казино');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="casino-index">
<div class="container">
    <div class="row">
        <div class="content col-lg-12">
    <h1><?= Html::encode($this->title) ?></h1>


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'city_id',
            'address_street',
            'phone',

        ],
    ]); ?>
<?php Pjax::end(); ?>
    </div>
</div>
</div>
</div>

