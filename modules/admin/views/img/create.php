<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ImgCasino */

$this->title = 'Create Img Casino';
$this->params['breadcrumbs'][] = ['label' => 'Img Casinos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="img-casino-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
