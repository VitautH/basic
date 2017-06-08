<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ImgCasino */

$this->title = 'Добавть изображение';

?>
<div class="img-casino-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_img', [
        'model' => $model,
        'id'=> $id
    ]) ?>

</div>
