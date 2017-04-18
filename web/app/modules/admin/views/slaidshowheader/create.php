<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ModulesSlaidshowHeader */

$this->title = 'Create Modules Slaidshow Header';
$this->params['breadcrumbs'][] = ['label' => 'Modules Slaidshow Headers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modules-slaidshow-header-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
