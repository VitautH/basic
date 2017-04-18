<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Slaidshow */

$this->title = 'Create Slaidshow';
$this->params['breadcrumbs'][] = ['label' => 'Slaidshows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slaidshow-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
