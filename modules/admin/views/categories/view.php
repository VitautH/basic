<?php
namespace  app\modules\admin\views\products;
use Yii;
use yii\helpers\Html;
use yii\widgets\DetailView;
use  yii\app;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категория', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы согласны удалить категорию?',
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
// ToDo: дописать вывод картинок
//            [
//                'attribute' => 'Images',
//                'format' => 'html',
//                'value' => function ($data) {
//                    return Html::img(Yii::getAlias('@web').'/'.Yii::getAlias('@img_path').'/'. $data['Image']['img_url'],
//                        ['width' => '200px']);
//                },
//            ]

        ]

    ]) ?>
</div>
