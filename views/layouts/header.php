<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use \yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use Yii\app;
// ToDo: Add meta tags
Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => 'Description of the page...'
] );
$this->registerJSFile('/js/modal.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerCssFile('//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css');
$this->registerJSFile('//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJSFile('/js/bootstrap.js', ['depends' => [\yii\web\JqueryAsset::className()]]);










?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<div class="overlay"></div>
<?php $this->beginBody() ?>
<header>
    <div class="top">
        <div class="container">

            <ul class="top_nav row">
                <li class="phone">
                    <span class="glyphicon glyphicon-earphone"></span>
                    <span>+7(981)1588513</span>
                </li>
                <li class="language_switch">
                    <span><a href="#">EN</a></span>
                    <span class="active"><a href="#">RU</a></span>
                    <span><a href="#">IT</a></span>
                </li>
                <?php // ToDo: исправить меню ?>
                <ul class="authority_block">
                <li class="login_logaut_block">
                    <?php

                    // ToDo: Исправить с false на true! Стиль кнопки в стил ссылки превратить!!!
                    if(Yii::$app->user->isGuest) {
                        ?>
                       <li class="login"> <?= Html::a('Войти', [Yii::$app->request->url.'#'], ['class' => 'login_form_click']) ?></li>

                        <li class="singup"><?= Html::a('Зарегистрироваться', [Yii::$app->request->url.'#'], ['class' => 'singup_form_click']) ?></li>

                        <?php
                    }
                    else {


                            ?>
                            <ul class="nav nav-pills">

                                <li role="presentation" class="dropdown ">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                        <?= $this->context->getUserName() ?> <span class="caret"></span>

                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= $this->context->getLinkAccaunt() ?>">Заказы</a></li>
                                        <li><a href="<?= $this->context->getLinkAccaunt() ?>/profile">Профиль</a></li>
                                    </ul>
                                </li>
                            </ul>

                            <li class="logout"><?= Html::beginForm(['/logout'], 'post')
                            . Html::submitButton(
                                'Выйти',
                                ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()?></li>
                  <?php


                    }
                    ?>
                </li>
                </ul>
            </ul>


        </div>


        <nav>

            <?//= $this->context->action->getUniqueId() ?>
            <div class="container">
                <div class="nav_container col-xs-12">
                    <?php
                    Menu::begin();
                    echo Menu::widget([
                        'options' => ['class' => 'navbar-nav'],
                        'items' => [
                            [
                                'url' => Yii::$app->homeUrl,
                                'template' => '<a href="{url}" ><span  class="ico_nav"></span> </a>',
                                'active' => ($this->context->action->getUniqueId() == 'site/index')
                            ],
                            [
                                'label' => 'О нас',
                                'url' => ['/about'],
                                'active' => ($this->context->slug == 'about')
                            ],

                            [
                                'label' => 'Кэшбэк в казино Минска',
                                'url' => ['/products'],
                                'active' => ($this->context->slug == 'products')
                            ],
                            [
                                'label' => 'контакты',
                                'url' => ['/site/contact'],
                                'active' => ($this->context->action->getUniqueId() == 'site/contact')
                            ]
                        ],
                    ]);
                    Menu::end();
                    ?>
                </div>
            </div>
        </nav>


    </div>


<? if (!empty($this->context->slaidshow)) : ?>


        <div class="header_container container">
            <section class="block_1">
            <div class="dark_background"></div>
            <img src="/image/logo.png" class="logo col-lg-4  col-lg-offset-4 col-xs-12 col-xs-0"/>
            <div class="clearfix"></div>
            <div class="slider_header col-lg-11 col-lg-offset-2 col-xs-12 col-xs-0" id="slider_1">
                <div class="arrow  col-lg-1 col-xs-1" id="arrow-left">

                </div>
                <div class="content col-lg-8 col-xs-10">
                    <span class="title"> </span>
                    <p>
                    </p>
                </div>
                <div class="arrow col-lg-1 col-xs-1" id="arrow-right">
                </div>



            </section>
            <div class="item_slideshow">
            </div>
            </div>


<?php endif; ?>

</header>
