<?php

namespace app\modules\admin\controllers;

use app\models\ImgProducts;
use Yii;
use app\models\Products;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends AdminController
{

    /**
     * @inheritdoc
     */


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Products::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {


        $model = new Products();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {




             return $this->redirect(['view', 'id' => $model->id]);
        } else {
              return $this->render('create', [
                  'model' => $model,
             ]);
        }



    }




    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    /*
        * Галерея
        */
    public function actionGallery($id){
        $response = ImgProducts::find()->where([ '=', 'product_id', $id ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $response
        ]);

        return $this->render('index_img', [
            'dataProvider' => $dataProvider,

        ]);
    }
    public function actionGalleryAdd($id)
    {
        $model = new ImgProducts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/admin/products/gallery', 'id' => $id]);
        } else {

            return $this->render('create_img', [
                'model' => $model,
                'id'=>$id
            ]);
        }




    }
    public function actionGalleryUpdate($id)
    {
        $model = ImgProducts::findOne($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            $response = ImgProducts::find()->where([ '=', 'product_id', $model->product_id ]);
            $dataProvider = new ActiveDataProvider([
                'query' => $response
            ]);

            return $this->render('index_img', [
                'dataProvider' => $dataProvider,

            ]);

        } else {

            return $this->render('update_img', [
                'model' => $model,
                'id'=>$id
            ]);
        }




    }
    public  function actionGalleryDelete($id){
        $product_id = ImgProducts::findOne($id);
        ImgProducts::findOne($id)->delete();

        return $this->redirect(['/admin/products/gallery?id='.$product_id->product_id]);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
