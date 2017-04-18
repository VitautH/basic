<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
?>


<footer>
    <div class="container">
   <div class="row">
       <div class="col-lg-4">

       </div>
       <div class="col-lg-2 footer_menu">
           <h3>О компании
           </h3>
           <ul>
               <li>Политика обработки ПД</li>
               <li>Новости</li>
               <li>Документы</li>
               <li>Контакты</li>
           </ul>
       </div>
       <div class="col-lg-2  footer_menu">
           <h3>О компании
           </h3>
           <ul>
               <li>Политика обработки ПД</li>
               <li>Новости</li>
               <li>Документы</li>
               <li>Контакты</li>
           </ul>
       </div>
       <div class="col-lg-2  footer_menu">
           <h3>О компании
           </h3>
           <ul>
               <li>Политика обработки ПД</li>
               <li>Новости</li>
               <li>Документы</li>
               <li>Контакты</li>
           </ul>
       </div>
   </div>
    </div>
</footer>

<?php $this->endBody() ?>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>



<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<script>

    $(document).ready(function(){


            $('.slider').slick({
                infinite: true,
                autoplay: true,
                speed:1200,
                slidesToShow: 4,
                slidesToScroll: 4
            });


    });


</script>
<?php
/*$sliders = array();

foreach ($this->context->slaidshow as  $key=>$slide){
    array_push($sliders, ['img_url' => [$slide->img_url],'title' => [$slide->title],'content' => [$slide->content]] );
}*/
?>
<? if (!empty($this->context->slaidshow)) : ?>
    <?= $this->render('_slideshow', ['images' => $this->context->slaidshow])?>
<? endif ?>

</body>
</html>