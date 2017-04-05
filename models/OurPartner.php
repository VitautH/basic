<?php
namespace app\models;

use Yii;
use  app\models\base\Casino;
use yii\helpers\ArrayHelper;
use app\core\ImageClass;
use yii\web\UploadedFile;

class OurPartner extends  \yii\db\ActiveRecord
{

public function viewAll (){
    return "Я работаю!";
}

public  function create (){
  return "Сохраняю данные!";
}
}