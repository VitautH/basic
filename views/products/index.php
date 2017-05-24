<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
use app\models\Products;
use app\models\Services;
use app\models\City;
use app\models\Casino;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile('/css/products.css');
$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
$this->registerJsFile('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
$this->title = 'Продукты';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="clearfix"></div>
<div class="products-index">
    <div class="container">
        <div class="row">
            <div class="bonus_plan_left_sidebar_block col-lg-4">
                <h3>
                    КАК ПОЛУЧИТЬ БОНУС ПЛАН?
                </h3>
            </div>
            <div class="bonus_plan_steps col-lg-8">
               <div class="step left_top col-lg-5">
                   <div class="img col-lg-2">
                       <div class="ico"></div>
                   </div>
                   <div class="one">  <span>1.</span></div>
                   <div class="action"><span>Регистрируетесь</span></div>
               </div>
                <div class="step top col-lg-5">
                    <div class="img col-lg-2">
                        <div class="ico"></div>
                    </div>
                    <div class="two"><span>2.</span></div>
                    <div class="action"><span>Выбераете план</span></div>
                </div>
                <div class="step left_bottom col-lg-5">
                    <div class="img col-lg-2">
                        <div class="ico"></div>
                    </div>
                    <div class="three"> <span>3.</span></div>
                    <div class="action"><span>Оплачиваете</span></div>
                </div>
                <div class="step bottom col-lg-5">
                    <div class="img col-lg-2">
                        <div class="ico"></div>
                    </div>
                    <div class="four"> <span>4.</span></div>
                    <div class="action"><span>Получаете кэшбэк</span></div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <article>
        <div class="row">

            <div class="filter_left_sidebar col-lg-4">
                <div class="form">
                    <div class="select_block">
              <select name="city" class="form-control">
                  <option disabled selected hidden>Выбрать город</option>
                  <?php

          foreach(City::find()->all() as $city):
              ?>
                  <option value="<?= $city['id']?>"><?=$city['name']?></option>
                  <?php

endforeach;
                  ?>

              </select>
                <select name="casino" class="form-control">
                    <option disabled selected hidden>Выбрать казино</option>
                    <?php

                    foreach(Casino::find()->all() as $casino):
                        ?>
                        <option value="<?= $casino['id']?>"><?=$casino['title']?></option>
                        <?php

                    endforeach;
                    ?>

                </select>
                    </div>
                    <div class="price_block">
                        <h4>Стоимость плана</h4>
                        <input type="text" name="min_price" placeholder="от">
                        <input type="text" name="max_price" placeholder="до">
                    </div>
                    <div class="checkbox_block">
                    <h4>Дополнительные услуги</h4>
                    <?php

                    foreach(Services::find()->all() as $service):
                        ?>
                    <div class="checkbox">
                            <input type="checkbox" name="service" id="checkbox_<?=$service['id']?>" value=" <?=$service['id']?>" aria-label="...">

                        <label for="checkbox_<?=$service['id']?>"><span class="check"></span>    <span class="title"> <?=$service['name']?></span>   </label>
                    </div>
                        <?php

                    endforeach;
                    ?>
                    </div>



</div>
            </div>
            <div class="products col-lg-8">


<?php foreach ($model as $product):
    ?>


                    <div class="item">


                        <div class="image">
                           <?php if ($product->img_url != null) {
                               ?>

                            <img width="293px" height="293px" src="<?= Yii::getAlias('@web') . '/' . Yii::getAlias('@img_path') . '/' .$product->img_url;?>"></div>

                        <?php  }
else { ?>
                        <img src="/image/noimg.jpg" width="293px" height="293px"></div>

    <?php
}
                        ?>
                        <div class="card">
                            <h3><a href="/products/view?id=<?=$product->id;?>"> <?=$product->casino->title;?></a></h3>


                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#description_<?=$product->id?>" aria-controls="description_<?=$product->id?>" role="tab" data-toggle="tab">Описание</a></li>
                                <li role="presentation"><a href="#cashback_<?=$product->id?>" aria-controls="cashback_<?=$product->id?>" role="tab" data-toggle="tab">Кэшбэк</a></li>
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
                            <span class="product_title">  <?= $product->title?></span>

                                <a class="booking" href="/products/view?id=<?=$product->id;?>"?>ЗАБРОНИРОВАТЬ</a>




                        </div>


                    </div>


                <?php
                endforeach;
                ?>


            </div>

        </div>
        </article>
    </div>


</div>

