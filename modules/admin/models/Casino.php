<?php

namespace app\modules\admin\models;

use Yii;
use  app\modules\admin\models\base\Casino as BaseCasino;
use yii\helpers\ArrayHelper;
use app\core\ImageClass;
use yii\web\UploadedFile;

class Casino extends BaseCasino
{
    public $imageFile;
public   $city_name;


    /*
   * Проверка на ввод данных + обязательные поля
   */
    public function rules()
    {
        return [[['title','city_id'],'required'],
            [['city_id'],'number'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['title', 'description', 'meta_keywords', 'meta_description', 'phone', 'address_street'],'safe'],
        ];
    }
    /*
       * @return array getCityList
       *
       */

    public function getCityList()
    {
        $connection = Yii::$app->db;
        $items_city = $connection->createCommand('SELECT id, name FROM city')->queryAll();
        $connection = null;
        return  ArrayHelper::map($items_city,'id','name');
    }

    /*
     * @return  string getCityName
     */
public  function getCityName(){

        if($this->city_id !== null) {
            $connection = Yii::$app->db;
            $this->city_name = $connection->createCommand("SELECT id, name FROM city WHERE id = $this->city_id")->queryOne();
            unset($connection);

           return $this->city_name['name'];
        }
        else {
            return "N/A";
        }

}
    /*
     *  Method  saveImage
     * после  сохранения Продукта
     */
    public function saveImage()
    {
        $imgUpload =  new ImageClass();

        $path = $imgUpload->uploadImage(UploadedFile::getInstance($this, 'imageFile'));
        $connection = Yii::$app->db;
        $connection->createCommand()->insert('img_casino', ['img_url' => $path, 'casino_id' => $this->id])->execute();
        $connection = null;


    }
    public function afterSave($insert, $changedAttributes)
    {
        if(UploadedFile::getInstance($this, 'imageFile')!==null){
            $this->saveImage();

        }




        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }


    /*
     * Method  Delete image
     *
     */
    public   function  deleteImage()
    {
        if ($this->getImages()!== null) {
            foreach ($this->getImages() as $image) {


                $imgDelete = new ImageClass();
                $imgDelete->deleteImage($image['img_url']);
            }


            $connection = Yii::$app->db;
            $connection->createCommand()->delete('img_casino', 'product_id=:id', array(':id' => $this->id))->execute();
            $connection = null;
        }

    }
    public function delete()
    {
        $this->deleteImage();



        return parent::delete(); // TODO: Change the autogenerated stub
    }
    /*
     * Получение изображений продукта
     * @return array|null
     */

    public function getImages()
    {
        $connection = Yii::$app->db;
        $get_img_url = $connection->createCommand("SELECT  id, img_url FROM img_casino WHERE casino_id =  $this->id")
            ->queryAll();
        if (!empty($get_img_url)) {
            return  $get_img_url;
        }
        else {
            return null;
        }

    }
    /*
     * Обновление картинок
     * ToDo: дописать множественное обновление картинок
     */

    public function updateImage(){
        $this->deleteImage();
        //$this->saveImage();
    }

    public function update($runValidation = true, $attributeNames = null)
    {
        $this->updateImage();
        return parent::update($runValidation, $attributeNames); // TODO: Change the autogenerated stub
    }
}

