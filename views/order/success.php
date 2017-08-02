<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use yii\widgets\ActiveForm;

$this->title = "Успешная оплата";

?>



<div class="succes-view">
    <div class="container">

        <div class="row">
          <h2> Спасибо, что воспользовались нашим сервисом! </h2>
            <p>Ваш купон: <b><?= $model['coupon']?></b></p>
            <a href="/<?=Yii::$app->language;?>/account">Ваши заказы</a>
        </div>

    </div>

</div>
