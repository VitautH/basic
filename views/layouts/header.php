<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use \yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use Yii\app;
use app\models\Setting;
use app\models\User;
use app\components\Lang;

// ToDo: Add meta tags

Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => 'Description of the page...'
]);
$this->registerJSFile('/js/modal.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerCssFile('//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css');
$this->registerJSFile('//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJSFile('/js/bootstrap.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$phone = Setting::find()->andWhere(['params' => 'phone'])->asArray()->one();

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

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
            <ul class="top_nav">

                <li class="phone">
                    <span class="glyphicon glyphicon-earphone"></span>
                    <span><?= $phone['value'] ?></span>
                </li>

                <li class="language_switch">
                    <div>
                        <span <?= (\Yii::$app->language == 'en') ? 'class="active"' : ''; ?>><a
                                    href="<?= \Yii::$app->request->BaseUrl ?>/switch/en">EN</a></span>
                        <span <?= (\Yii::$app->language == 'ru') ? 'class="active"' : ''; ?>><a
                                    href="<?= \Yii::$app->request->BaseUrl ?>/switch/ru">RU</a></span>
                    </div>
                </li>

                <li class="li_authority_block">
                    <ul class="authority_block">
                        <li class="login_logaut_block"></li>
                        <?php
                        // ToDo: Исправить с false на true! Стиль кнопки в стил ссылки превратить!!!
                        if (Yii::$app->user->isGuest) {
                            ?>
                            <li class="login"> <?= Html::a(_t('Войти')
                                    , [Yii::$app->request->url . '#'], ['class' => 'login_form_click']) ?></li>

                            <li class="singup"><?= Html::a(_t('Зарегистрироваться'), [Yii::$app->request->url . '#'], ['class' => 'singup_form_click']) ?></li>

                            <?php
                        } else {


                            ?>
                            <ul class="nav nav-pills">

                                <li role="presentation" class="dropdown ">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="true">
                                        <?= $this->context->getUserName() ?> <span class="caret"></span>

                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/<?= \Yii::$app->language; ?>/account"><?= _t('Заказы') ?></a></li>
                                        <li>
                                            <a href="/<?= \Yii::$app->language; ?>/account/profile"><?= _t('Профиль') ?></a>
                                        </li>
                                        <? if (($this->context->role_id == User::MANAGER) or ($this->context->role_id == User::ADMIN)):
                                            ?>
                                            <li>
                                                <a href="/<?= \Yii::$app->language; ?>/manager"><?= _t('Проверить купон') ?></a>
                                            </li>
                                            <?php
                                        endif;
                                        ?>
                                    </ul>
                                </li>
                            </ul>

                            <li class="logout"><?= Html::beginForm(['/logout'], 'post')
                                . Html::submitButton(
                                    _t('Выйти'),
                                    ['class' => 'btn btn-link logout']
                                )
                                . Html::endForm() ?></li>
                            <?php


                        }
                        ?>
                        </li>
                    </ul>

            </ul>


        </div>
    </div>
    <nav>
        <div class="container">


            <?php
            Menu::begin();
            echo Menu::widget([
                'options' => ['class' => 'navbar-nav'],
                'items' => [
                    [
                        'template' => '<a href="' . Yii::$app->homeUrl. \Yii::$app->language . '" >' . _t('Главная') . ' </a>',
                        'active' => ($this->context->action->getUniqueId() == 'site/index')
                    ],
                    [
                        'label' => _t('Получить бонус-план'),
                        'url' => ['/' . \Yii::$app->language . '/products'],
                        'active' => ($this->context->slug == 'products')
                    ],
                    [
                        'label' => _t('О нас'),
                        'url' => ['/' . \Yii::$app->language . '/about'],
                        'active' => ($this->context->slug == 'about')
                    ],
                    [
                        'label' => _t('Контакты'),
                        'url' => ['/' . \Yii::$app->language . '/contact'],
                        'active' => ($this->context->action->getUniqueId() == 'site/contact')
                    ]
                ],
            ]);
            Menu::end();
            ?>

        </div>
    </nav>
    <nav class="phone">
        <ul class="nav nav-pills">

            <li role="presentation" class="dropdown ">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="true">
                    <span class="ico_nav"></span>
                </a>
                <ul class="dropdown-menu">
                    <?php
                    Menu::begin();
                    echo Menu::widget([
                        'options' => ['class' => 'phone_menu'],
                        'items' => [
                            [
                                'label' => _t('Главная'),
                                'url' => Yii::$app->homeUrl. \Yii::$app->language,
                                'active' => ($this->context->action->getUniqueId() == 'site/index')
                            ],


                            [
                                'label' => _t('Получить бонус-план'),
                                'url' => ['/' . \Yii::$app->language . '/products'],
                                'active' => ($this->context->slug == 'products')
                            ],
                            [
                                'label' => _t('О нас'),
                                'url' => ['/' . \Yii::$app->language . '/about'],
                                'active' => ($this->context->slug == 'about')
                            ],
                            [
                                'label' => _t('Контакты'),
                                'url' => ['/' . \Yii::$app->language . '/contact'],
                                'active' => ($this->context->action->getUniqueId() == 'site/contact')
                            ]
                        ],
                    ]);
                    Menu::end();
                    ?>

                </ul>
            </li>
        </ul>
    </nav>
    <? if (!empty($this->context->slaidshow)) : ?>
        <div class="main-slider">
            <div class="container" style="padding: 0;">
                <section class="block_1"
                         style="background-image: url(&quot;/uploads/images/banner/f24bb9c0b759829b223e2c65248a3b4f.jpg&quot;);">
                    <div class="my-flex-container">
                        <div class="my-flex-block">
                            <img src="/image/logo.png" class="logo col-lg-4  col-lg-offset-4 col-xs-12 col-xs-0">

                        </div>


                        <div class="my-flex-block">
                            <div class="slider_header col-lg-10 col-xs-12" id="slider_1">
                                <div class="arrow  col-lg-1 col-xs-1" id="arrow-left">

                                </div>
                                <div class="content col-lg-8 col-xs-8">
                                    <span class="title"> </span>
                                    <p>
                                    </p>
                                </div>
                                <div class="arrow col-lg-1 col-xs-1" id="arrow-right">
                                </div>
                            </div>
                        </div>

                        <div class="my-flex-block">
                            <div class="item_slideshow">

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    <?php endif; ?>

</header>
