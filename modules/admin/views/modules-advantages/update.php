<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ModulesAdvantages */

$this->title = 'Изменить слайд: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Модуль Приемущества', 'url' => ['index']];

?>
<div class="modules-advantages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
