<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
use app\models\Products;
use app\models\Services;
use app\models\City;
use app\models\Casino;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile('/css/products.css');
$this->title = _t('Бонус-план');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJSFile('/js/form.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJSFile('/js/bootstrap.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="clearfix"></div>
<div class="products-index">
    <div class="container">
        <div class="row">
            <div class="bonus_plan_left_sidebar_block col-lg-4 col-xs-12 col-sm-12">
                <h3>
                    <?= _t('Как получить бонус-план') ?> ?
                </h3>
            </div>
            <div class="bonus_plan_steps col-lg-8 col-xs-12 col-sm-12">
                <div class="step left_top col-lg-5 col-xs-12 col-sm-5">
                    <div class="img col-lg-2 col-xs-3 col-sm-3 ">
                        <div class="ico"></div>
                    </div>
                    <div class="one"><span>1.</span></div>
                    <div class="action"><span><?= _t('Регистрируетесь'); ?></span></div>
                </div>
                <div class="step top col-lg-5 col-xs-12 col-sm-5">
                    <div class="img col-lg-2 col-xs-3 col-sm-3">
                        <div class="ico"></div>
                    </div>
                    <div class="two"><span>2.</span></div>
                    <div class="action"><span><?= _t('Выбираете план'); ?></span></div>
                </div>
                <div class="step left_bottom col-lg-5 col-xs-12 col-sm-5">
                    <div class="img col-lg-2 col-xs-3 col-sm-3">
                        <div class="ico"></div>
                    </div>
                    <div class="three"><span>3.</span></div>
                    <div class="action"><span><?= _t('Оплачиваете'); ?></span></div>
                </div>
                <div class="step bottom col-lg-5 col-xs-12 col-sm-5">
                    <div class="img col-lg-2 col-xs-3 col-sm-3">
                        <div class="ico"></div>
                    </div>
                    <div class="four"><span>4.</span></div>
                    <div class="action"><span><?= _t('Получаете  бонус-план'); ?></span></div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <article>
            <div class="row">

                <div class="filter_left_sidebar col-lg-4 col-xs-12 col-sm-12">

                    <div class="form">
                        <?php $form = ActiveForm::begin([
                            'id' => 'filter_form',

                        ]) ?>
                        <div class="select_block col-sm-4 col-lg-12">
                            <select name="city" class="form-control">
                                <option disabled selected hidden><?= _t('Выбрать город'); ?></option>
                                <?php

                                foreach (City::find()->all() as $city):
                                    ?>
                                    <option value="<?= $city['id'] ?>"><?= $city['name'] ?></option>
                                    <?php

                                endforeach;
                                ?>

                            </select>
                            <select name="casino" class="form-control">
                                <option disabled selected hidden><?= _t('Выбрать казино'); ?></option>
                                <?php

                                foreach (Casino::find()->all() as $casino):
                                    ?>
                                    <option value="<?= $casino['id'] ?>"><?= $casino['title'] ?></option>
                                    <?php

                                endforeach;
                                ?>

                            </select>
                        </div>
                        <div class="price_block col-sm-4 col-lg-12">
                            <h4><?= _t('Стоимость плана (в у.е)'); ?></h4>
                            <input type="number" name="min_price" step="1" min="0" max="100000" placeholder="<?= _t('от');?>">
                            <input type="number" name="max_price" step="1" min="0" max="100000" placeholder="<?= _t('до');?>">
                        </div>
                        <div class="checkbox_block col-sm-4 col-lg-12">
                            <h4><?= _t('Дополнительные услуги'); ?></h4>
                            <?php

                            foreach (Services::find()->all() as $service):
                                ?>
                                <div class="checkbox">
                                    <input type="checkbox" name="service[]" id="checkbox_<?= $service['id'] ?>"
                                           value=" <?= $service['id'] ?>" aria-label="...">

                                    <label for="checkbox_<?= $service['id'] ?>"><span class="check"></span> <span
                                                class="title"> <?= $service['name'] ?></span> </label>
                                </div>
                                <?php

                            endforeach;
                            ?>
                        </div>
                        <div id="filter_submit"> <?= _t('Искать'); ?></div>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
                <div class="products col-lg-8 col-xs-12">
                    <?php foreach ($model as $product):
                        ?>
                        <div class="item">
                            <div class="image">
                                <?php if ($product->logo_id != null) {
                                    ?>
                                    <img width="293" height="293"
                                         src="<?= Yii::$app->imagemanager->getImagePath($product->logo_id, '293', '293', 'inset') ?>"/>


                                <?php } else { ?>
                                    <img src="/image/noimg.jpg" width="293" height="293">

                                    <?php
                                }
                                ?>
                            </div>
                            <div class="card">
                                <h3>
                                    <a href="/<?=Yii::$app->language;?>/products/view?id=<?= $product->id; ?>"> <?= $product->casino->title; ?></a>
                                </h3>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#description_<?= $product->id ?>"
                                                                              aria-controls="description_<?= $product->id ?>"
                                                                              role="tab"
                                                                              data-toggle="tab"><?= _t('Описание'); ?></a>
                                    </li>
                                    <li role="presentation"><a href="#cashback_<?= $product->id ?>"
                                                               aria-controls="cashback_<?= $product->id ?>"
                                                               role="tab" data-toggle="tab"><?= _t('Бонус-план'); ?></a>
                                    </li>
                                    <li role="presentation"><a href="#services_<?= $product->id ?>"
                                                               aria-controls="services_<?= $product->id ?>"
                                                               role="tab"
                                                               data-toggle="tab"><?= _t('Включенные услуги'); ?></a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active description"
                                         id="description_<?= $product->id ?>">
                                        <div><?= $product->description; ?></div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane cashback" id="cashback_<?= $product->id ?>">
                                        <div><?= $product->cashback ?> $</div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane services" id="services_<?= $product->id ?>">
                                        <ul>
                                            <?php foreach ($product->productsServices as $product_service):
                                                $id = $product_service->id_service;
                                                ?>
                                                <li><?= Services::findOne($id)->name; ?></li>
                                                <?
                                            endforeach;
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <span class="product_title">  <?= $product->price ?> BYN.</span>
                                <a class="booking" href="/<?=Yii::$app->language;?>/products/view?id=<?= $product->id; ?>"
                                   ?><?= _t('Забронировать'); ?></a>
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

