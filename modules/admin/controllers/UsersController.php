<?php

namespace app\modules\admin\controllers;

use app\controllers\Base\MainController;
use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends AdminController
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->setScenario(User::SCENARIO_CREATE);
        if (Yii::$app->request->isPost) {

            $model->load($_POST);
            /*
                            *  Validation
                            */
            if (\Yii::$app->request->isAjax) {
                return $this->ajaxValidation($model);


            } else {
                if ($model->validate() && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

        }

      else {
            return $this->render('create', [
                'model' => $model,
                'create'=> true
            ]);
        }


    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario(User::SCENARIO_UPDATE_ADMIN);
        if (Yii::$app->request->isPost) {

            $model->load($_POST);
            /*
                  *  Validation
                  */
            if (\Yii::$app->request->isAjax) {
                return $this->ajaxValidation($model);


            } else {
                if ($model->validate() && $model->save()) {
                    return $this->render('update', [
                        'model' => $model,
                        'update'=>true
                    ]);
                }

            }
        }
        else {
            return $this->render('update', [
                'model' => $model,
                'update'=>true
            ]);
        }

    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    /**
     * @throws \yii\base\ExitException
     */
    protected function ajaxValidation($model)
    {

            $model->load(\Yii::$app->request->post());


            \Yii::$app->response->format = Response::FORMAT_JSON;
            \Yii::$app->response->data   = ActiveForm::validate($model);


            \Yii::$app->response->send();
            \Yii::$app->end();

    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
