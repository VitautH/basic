<?php
namespace  app\modules\admin\views\products;
use Yii;
use yii\helpers\Html;
use yii\widgets\DetailView;
use  yii\app;
/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'casinoName',
            'cost',
            'description',
            'cashback',
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
            ]

        ]

    ]) ?>
</div>
