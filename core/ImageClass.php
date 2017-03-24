<?php
namespace app\core;
use Yii;
use yii\web\UploadedFile;
/*
 * Класс для работы с изображениями
 *  @uploadImage();
 * @deleteImage
 */
class ImageClass{


    /**
     * @var $imageFile
     * (файловый дескриптор)
     */
 private  $imageFile;

 /*
  * @var $baseimagePath
  * (путь к папке загрузки изображений)
  */
 private   $baseImagePath;

public  function __construct()
{
    $this->baseImagePath=Yii::getAlias('@img_path');
}

    /*
     * Получить уникальное имя файла
     * @return   string @$name
     */
    private  function getRandomFileName($extension)
    {
        $extension = $extension ? '.' . $extension : '';
        $path = $this->baseImagePath ? $this->baseImagePath . '/' : '';

        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name . $extension;
        } while (file_exists($file));

        return $name;
    }
    /*
   * Загрузка изображения
   * @return pathSaveImage
   */
    public  function uploadImage($imgIstance)
    {
        $name = $this->getRandomFileName($imgIstance->extension);

    $imgIstance->saveAs($this->baseImagePath . '/' . $name . '.' . $imgIstance->extension);

     return   $name . '.' . $imgIstance->extension;


    }

    /*
     * Удаление изображений
     * @return bool
     */

    public    function deleteImage($nameImage){


        if (file_exists($this->baseImagePath . '/' .$nameImage)) {
            unlink($this->baseImagePath . '/' . $nameImage);
return true;
        }
        else {
            return false;
        }


    }
    /*
     * Обновление изображений
     *  Зачем?
     * ToDo: дописать!
     */

    public  function updateImage(){

        if ($this->validate()) {
            $path = 'uploads/' . $this->id. '.' . $this->imageFile->extension;
            $this->imageFile->saveAs('uploads/' . $this->id. '.' . $this->imageFile->extension);


            $connection = Yii::$app->db;
            $get_img_url = $connection->createCommand()
                ->update('img_product', array(
                    'img_url'=>'Tester',
                ), 'product_id=:id', array(':id'=>$this->id));
            unlink(Yii::getAlias('@web').$get_img_url['img_url']);



            $connection=null;
            return true;
        } else {
            return false;
        }


    }
}