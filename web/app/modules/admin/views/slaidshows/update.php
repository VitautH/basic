<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Slaidshow */

$this->title = 'Update Slaidshow: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Slaidshows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="slaidshow-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
