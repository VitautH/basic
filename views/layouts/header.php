<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use \yii\widgets\Menu;
use yii\widgets\Breadcrumbs;

// ToDo: Add meta tags
Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => 'Description of the page...'
] );
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
<?php $this->beginBody() ?>
<header>
    <div class="top">
        <div class="container">

            <div class="row">
                <div class="phone col-lg-2">
                    <span class="glyphicon glyphicon-earphone"></span>
                    <span>+7(981)1588513</span>
                </div>
                <div class="language_switch col-lg-2 col-lg-offset-2">
                    <span><a href="#">EN</a></span>
                    <span class="active"><a href="#">RU</a></span>
                    <span><a href="#">IT</a></span>
                </div>
                <div class="login col-lg-3 col-lg-offset-3">
                    <?php

                    // ToDo: Исправить с false на true! Стиль кнопки в стил ссылки превратить!!!
                    if(Yii::$app->user->isGuest) {
                        ?>
                        <?= Html::a('Войти', ['/login']) ?>
                        |
                        <?= Html::a('Зарегистрироваться', ['/singup']) ?>
                        <?php
                    }
                    else {


                        echo  Html::beginForm(['/logout'], 'post')
                            . Html::submitButton(
                                'Выйти',
                                ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm();
                    }
                    ?>
                </div>
            </div>

        </div>
        <nav>
            <div class="nav_container col-lg-12 col-md-offset-1 col-sm-offset-0 col-sm-offset-0">

                <?php
                Menu::begin();
                echo Menu::widget([
                    'options' => ['class' => 'navbar-nav col-lg-11'],
                    'items' => [
                        ['url' => Yii::$app->homeUrl, 'template' => '<a href="{url}" > <span class="ico_nav glyphicon glyphicon-menu-hamburger"></span></a>'],
                        ['label' => 'О нас', 'url' => ['/articles']],
                        ['label' => 'Всё о казино Минска', 'url' => ['/casino']],
                        ['label' => 'Всё о казино Минска', 'url' => ['/products']],
                        ['label' => 'контакты', 'url' => ['/site/contact']]
                    ],
                ]);
                Menu::end();
                ?>
            </div>
        </nav>
    </div>



    <section class="block_1">

        <div class="container">





            <img src="/image/logo.png" class="logo col-lg-4  col-lg-offset-4"/>



            <div class="clearfix"></div>
            <div class="slider_header col-lg-11 col-lg-offset-2" id="slider_1">
                <div class="arrow  col-lg-1" id="arrow-left">
                    <!--            ToDo: Стрелки добавить! -->
                    <!--<span class="glyphicon glyphicon-arrow-left"></span>-->
                </div>
                <div class="content col-lg-8">
    <span class="title">

    </span>
                    <p>

                    </p>

                </div>
                <div class="arrow col-lg-1" id="arrow-right">

                </div>





            </div>


    </section>


</header>