<?php

namespace app\controllers;

use app\modules\user\components\RbacFilter;
use Yii;
use app\models\MailingLog;
use app\models\MailingLogSearch;
use yii\bootstrap\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * MailingLogController implements the CRUD actions for MailingLog model.
 */
class MailingLogController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'rbac' => RbacFilter::className(),
        ];
    }

    /**
     * Lists all MailingLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MailingLogSearch();
        $searchModel->text = Yii::$app->request->get('search');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MailingLog model.
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
    public function actionEdit()
    {
        if($id = Yii::$app->request->get('id')){
            $model = $this->findModel($id);
            $this->view->title = Yii::t('app', 'Update Mailing Log');
        }else{
            $model = new MailingLog();
            $this->view->title = Yii::t('app', 'Create Mailing Log');
        }

        if ($errors = $this->performAjaxValidation($model)) {
            return $errors;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(Yii::$app->request->isAjax){
                return 'success';
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if(Yii::$app->request->isAjax){
                return $this->renderPartial('edit', [
                    'model' => $model,
                ]);
            }
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MailingLog model.
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
     * Finds the MailingLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MailingLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MailingLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function performAjaxValidation($model)
    {
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
}