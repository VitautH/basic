<?php

/* @var $this yii\web\View */

use  yii\app;
$this->title = 'Casino';

?>
<div class="container">
    <div class="row">
        <div class="offer">


            <div class="col-lg-5">
                <span class="title_1"> Хотите воспользоваться услугой?</span>
            </div>

            <div class="col-lg-5 col-lg-offset-1">
                <div class="arrow_box"><a href="#"> Забронировать сейчас</a></div>
            </div>
        </div>
    </div>
</div>
<article>
<div class="container">
<div class="row">
        <div class="banner_left col-lg-3">
<img src="<?php echo Yii::getAlias('@web').'/'.Yii::getAlias('@img_path')  ?>/banner/banner.jpg"/>
        </div>

<div class="content col-lg-9">
    <h1>новости</h1>


    <? foreach ($articles as $key=>$article) : ?>
        <div class="<?= ($key== 2) ? 'end':'' ?> news col-lg-4">
            <h2>
                <?= $article->title?>
            </h2>
            <p>
                <?= $article->brief?>
            </p>
            <span class="more">     <a href="articles/view?id=<?= $article->id;?>"> подробнее </a> </span>
        </div>
    <? endforeach; ?>

</div>
<div class="partner_block col-lg-9">
<h2>НАШИ ПАРТНЁРЫ</h2>
    <div class="silder">
        <img src=""/>

    </div>
</div>
    </div>
<div class="row">
    <div class="bonus_plan_block col-lg-4">

    </div>
    <div class="bonus_plan col-lg-8">

    </div>
</div>
</div>
</article>