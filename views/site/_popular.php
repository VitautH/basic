<?php
use yii\helpers\Html;
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 07.05.2017
 * Time: 20:01
 */
?>
<?php foreach ($products as  $key=>$product) : ?>
    <div class="col-lg-5 col-sm-5 col-xs-12   <?= ($key <= 1) ? 'block-top ':'block-bottom' ?>">
        <div class="img col-lg-2 col-xs-3 col-sm-3">
            <?php   if($product->logo_id !== null) {
                ?>
           <img  width="120" height="117"  src="<?= Yii::$app->imagemanager->getImagePath($product->logo_id, '120', '117','inset')?>"/>
            <?php }
            else {
                ?>
                <img width="120" height="117" src="<?= Yii::getAlias('@web') . '/image/default_img_casino.png'?>"/>

                <?
            }
            ?>
        </div>
        <div class="bonus_plan_steps_content col-lg-3 col-sm-5 col-xs-9">
            <h3><a href="/<?=\Yii::$app->language;?>/products/view?id=<?= $product->id; ?>"><?= $product->title;?></a></h3>
<img width="60px" height="60px" src="<?= Yii::$app->imagemanager->getImagePath($product->casino->logo_id, '60', '60') ?>">
<span class="price"><?= $product->price;?> BYN</span>
        </div>
        <div class="booking hidden-xs"><a href="/<?=\Yii::$app->language;?>/products/view?id=<?= $product->id; ?>"> <?= _t('Забронировать сейчас');?>!</a></div>
    </div>

<? endforeach; ?>


