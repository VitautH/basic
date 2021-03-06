<?php

namespace app\modules\admin\controllers;

use app\models\ImgCasino;
use Yii;
use app\models\Casino;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CasinoController implements the CRUD actions for Casino model.
 */
class CasinoController extends AdminController
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
     * Lists all Casino models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Casino::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Casino model.
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
     * Creates a new Casino model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Casino();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Casino model.
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
     * Deletes an existing Casino model.
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
        $response = ImgCasino::find()->where([ '=', 'casino_id', $id ]);

    $dataProvider = new ActiveDataProvider([
        'query' => $response
    ]);

    return $this->render('index_img', [
        'dataProvider' => $dataProvider,

    ]);
}
public function actionGalleryAdd($id)
{
    $model = new ImgCasino();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['/admin/casino/gallery', 'id' => $id]);
    } else {

        return $this->render('create_img', [
            'model' => $model,
            'id'=>$id
        ]);
    }




}

public  function actionGalleryDelete($id){
    $casino_id = ImgCasino::findOne($id);
    ImgCasino::findOne($id)->delete();

    return $this->redirect(['/admin/casino/gallery?id='.$casino_id->casino_id]);
}
    public function actionGalleryUpdate($id)
    {
        $model = ImgCasino::findOne($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            $response = ImgCasino::find()->where([ '=', 'casino_id', $model->casino_id ]);
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
    /**
     * Finds the Casino model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Casino the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Casino::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
