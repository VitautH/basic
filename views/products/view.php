<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\controllers\UsersController;
/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'cost',
            'description',
            'cashback',
            'casino_id',
        ],
    ])


    ?>

    <?php

   echo $this->context->user_role;
    ?>

</div>
