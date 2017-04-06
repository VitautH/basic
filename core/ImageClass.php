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
 /*
  * string @var $folder
  * параметр, указывающий на папку в $baseimagePath
  * Пример, 'sliders/' (не забывать '/');
  */
 private $folder;

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
     * resource @var $imgIstance - дескриптор изображения
   * string @var $folder
  * параметр, указывающий на папку в $baseimagePath
  * Пример, 'sliders/' (не забывать '/');
   * @return pathSaveImage
   */
    public  function uploadImage($imgIstance, $folder)
    {
        $this->folder= $folder;
        $name = $this->getRandomFileName($imgIstance->extension);

    $imgIstance->saveAs($this->baseImagePath . '/'.$this->folder . $name . '.' . $imgIstance->extension);

     return   $this->folder. $name . '.' . $imgIstance->extension;


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