<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile('/css/main.css');
$this->registerCssFile('/css/products.css');
$this->title = 'Продукты';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="products-index">
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
            'price',
            'description:ntext',
            'cashback'

        ],
    ]); ?>
<?php Pjax::end(); ?></div>
        </div>
    </div>
</div>

