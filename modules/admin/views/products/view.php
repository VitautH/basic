<?php
namespace  app\modules\admin\views\products;
use Yii;
use yii\helpers\Html;
use yii\widgets\DetailView;
use  yii\app;
use app\models\Services;
use yii\helpers\ArrayHelper;
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
            'price',
            ['attribute'=>'description',
                'format'=>'html',
                'value'=> function($data){
                    return Html::decode($data->description);
                }
            ],

            'cashback',

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

        ]

    ]) ?>
    <table id="w0" class="table table-striped table-bordered detail-view" style="border: 0; margin-top: -20px;"><tbody>
        <tr><th>Услуги:</th><td> <ul><?php
                foreach (Services::find()->all() as $service):
                    if(!empty($model->hasService($service->id))){
                     ?>
                <li>
                    <?=$service->name?>
                </li>
                      <?
                    }

                endforeach;
                    ?></ul></td></tr>
      </tbody></table>

</div>
