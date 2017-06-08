<?php
/**
 * Created by PhpStorm.
 * User: Vitaut
 * Date: 25.05.2017
 * Time: 23:25
 */
use app\models\Services;
use app\models\City;
use app\models\Casino;

 foreach ($model as $product):
    ?>


    <div class="item">


        <div class="image">
            <?php if ($product->logo_id != null) {
                ?>
                <img  width="293" height="293"  src="<?= Yii::$app->imagemanager->getImagePath($product->logo_id, '293', '293','inset')?>"/>


            <?php  }
            else { ?>
                <img src="/image/noimg.jpg" width="293" height="293">

                <?php
            }
            ?>
        </div>
    <div class="card">
        <h3><a href="/products/view?id=<?=$product->id;?>"> <?=$product->casino->title;?></a></h3>


        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#description_<?=$product->id?>" aria-controls="description_<?=$product->id?>" role="tab" data-toggle="tab">Описание</a></li>
            <li role="presentation"><a href="#cashback_<?=$product->id?>" aria-controls="cashback_<?=$product->id?>" role="tab" data-toggle="tab">бонус-план</a></li>
            <li role="presentation"><a href="#services_<?=$product->id?>" aria-controls="services_<?=$product->id?>" role="tab" data-toggle="tab">Включенные услуги</a></li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active description" id="description_<?=$product->id?>"><p><?=$product->description;?></p></div>
            <div role="tabpanel" class="tab-pane cashback"  id="cashback_<?=$product->id?>"><p><?=$product->cashback?></p></div>
            <div role="tabpanel" class="tab-pane services"  id="services_<?=$product->id?>">
                <ul>
                    <?php foreach ($product->productsServices as $product_service):
                        $id = $product_service->id_service;
                        ?>
                        <li><?=Services::findOne($id)->name;?></li>
                        <?


                    endforeach;


                    ?>
                </ul>
            </div>

        </div>
        <span class="product_title">  <?= $product->price?> руб.</span>

        <a class="booking" href="/products/view?id=<?=$product->id;?>"?>ЗАБРОНИРОВАТЬ</a>




    </div>


 </div>


    <?php
endforeach;

