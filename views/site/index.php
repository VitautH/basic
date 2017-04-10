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
<img width="295" height="618" src="<?php echo Yii::getAlias('@web').'/'.Yii::getAlias('@img_path')  ?>/banner/banner.jpg"/>
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
    <!--    <div class="silder">-->
    <!--        --><? // foreach ($ourpartner as $key=>$ourpartner) : ?>
    <!--            <img src="-->
    <?php //echo Yii::getAlias('@web').'/'.Yii::getAlias('@img_path')."/". $ourpartner->img_url?><!--"/>-->
    <!---->
    <!---->
    <!---->
    <!--        --><?php //endforeach; ?>
    <!---->
    <!--    </div>-->
    <div class="silder">
        <img src="/uploads/images/sliders/1e2a8b4b5b41e09606d004dd5e9a4100.png">


        <img src="/uploads/images/sliders/26ed7fd4350c956bacad0557e5853653.png">


        <img src="/uploads/images/sliders/c032b155cf1479891495bc58ddf1dd3e.png">


        <img src="/uploads/images/sliders/efa75b454176109729e19669f355e63d.png">


    </div>
</div>
    </div>
<div class="row">
    <div class="bonus_plan_left_sidebar_block col-lg-4">
<h3>
    ПОПУЛЯРНЫЕ БОНУС-ПЛАНЫ
</h3>
    </div>
    <div class="bonus_plan_steps col-lg-8">
        <?php

        foreach ($casinos as  $key=>$casino){ ?>
            <div class="col-lg-5 <?= ($key <= 1) ? 'block-top ':'block-bottom' ?>">
                <div class="img col-lg-2">
                    <?php   if($casino->getImage()['img_url'] !== null) {

                    ?>
                    <img width="120" height="117" src="<?= Yii::getAlias('@web') . '/' . Yii::getAlias('@img_path') . '/' . $casino->getImage()['img_url'];?>"/>
                <?php }
                else {
                        ?>
                    <img width="120" height="117" src="<?= Yii::getAlias('@web') . '/image/default_img_casino.png'?>"/>

                    <?
                }
                    ?>
                </div>
                <div class="bonus_plan_steps_content col-lg-3">
                    <h3><?= $casino->title;?></h3>

                  <a  href="#">выберите план</a>
                </div>

            </div>


    <?    } ?>

    </div>
</div>
</div>
</article>
<div class="container bottom">
    <div class="row">
        <div class="left_block col-lg-4">
<h3>
    ПРЕИМУЩЕСТВА РАННЕГО БРОНИРОВАНИЯ
</h3>
        </div>
        <div class="center_block col-lg-5">
<div class="block_1 col-lg-12">
<div class="icon col-lg-2"></div>
    <div class="col-lg-8"><h3>ПОЛУЧАЕТЕ НА 10% БОЛЬШЕ</h3>
        <p>Среди них широкий ассортимент, квалифицированный персонал, привлекательные условия.</p>
    </div>
            </div>
            <div class="block_2 col-lg-12">
                <div class="icon col-lg-2"></div>
                <div class="col-lg-8"><h3>ВЫСОКОЕ КАЧЕСТВО УСЛУГ</h3>
                    <p>
                        Среди них широкий ассортимент, квалифицированный персонал, привлекательные условия.
                    </p>
                </div>

            </div>
            <div class="block_3 col-lg-12">
                <div class="icon col-lg-2"></div>
                <div class="col-lg-8"><h3>ЭКОНОМИТЕ СВОЕ ВРЕМЯ</h3><p>
                        Среди них широкий ассортимент, квалифицированный персонал, привлекательные условия.
                    </p></div>
            </div>
        </div>
        <div class="right_block col-lg-3">
            <h3>
                ВЫСОКОЕ
                КАЧЕСТВО
                УСЛУГ
            </h3>
            <p>
                Среди них широкий ассортимент, квалифицированный персонал, привлекательные условия
            </p>

        </div>
    </div>
</div>