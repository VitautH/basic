<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web;
/* @var $this yii\web\View */
/* @var $model app\models\base\Articles */

$this->title = $model->title;
// ToDo: Add meta tags;
//$this->meta_description = $model->meta_description;
//$this->metakeywords = $model->meta_keywords;
?>
<div class="article-view container">
    <div class="row">
        <article>
        <div class="article_container col-lg-12">

            <h1><?=$model->title?></h1>
<div class="content">
                <?=$model->brief?>
                <?= $model->text?>
</div>

        </div>
        </article>
    </div>
</div>

