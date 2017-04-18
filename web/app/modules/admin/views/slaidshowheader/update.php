<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ModulesSlaidshowHeader */

$this->title = 'Update Modules Slaidshow Header: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Modules Slaidshow Headers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="modules-slaidshow-header-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
