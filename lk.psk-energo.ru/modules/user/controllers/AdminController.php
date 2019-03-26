<?php

namespace app\modules\user\controllers;

use app\modules\user\components\RbacFilter;
use Yii;
use app\modules\user\models\User;
use app\modules\user\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\bootstrap\ActiveForm;

/**
 * AdminController implements the CRUD actions for User model.
 */
class AdminController extends Controller {
    public function behaviors() {
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserSearch();
        $searchModel->text = Yii::$app->request->get('search');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = [
            'pageSize' => 10,
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionEdit() {
        if($id = Yii::$app->request->get('id')) {
            $model = $this->findModel($id);
            $this->view->title = Yii::t('app', 'Update User');
        }else {
            $model = new User();
            $model->scenario = 'insert';
            $this->view->title = Yii::t('app', 'Create User');
        }

        if($errors = $this->performAjaxValidation($model)) {
            return $errors;
        }

        if($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->authManager->revokeAll($model->id);
            $assignments = Yii::$app->request->post('permissions');
            if($assignments && is_array($assignments)) {
                foreach($assignments as $assignment) {
                    Yii::$app->authManager->assign($assignment, $model->id);
                }
            }

            if(Yii::$app->request->isAjax) {
                return 'success';
            }
            return $this->redirect(['index']);
        }else {
            if(!$model->isNewRecord) {
                $permissions = array_keys(Yii::$app->authManager->getAssignments($model->id));
            }else {
                $permissions = [];
            }

            $permissionsArray = [
                'index' => 'Просмотр',
                'edit' => 'Редактирование',
                'delete' => 'Удаление',
            ];

            $identitiesArray = [
                'user-admin' => 'Пользователь',
                'tender' => 'Тендер',
                'customer' => 'Заказчик',
                'staff' => 'Сотрудник',
                'supplier' => 'Поставщики',
                'supplier-group' => 'Группы поставщиков',
                'mailing-log' => 'Лог рассылки',
            ];

            $customIdentitiesArray = [
                'site-mailing' => 'Просмотр страницы "Рассылка"',
                'product-index' => 'Просмотр страницы "Товары"',
                'import' => 'Импорт товаров',
            ];

            if(Yii::$app->request->isAjax) {
                return $this->renderPartial('edit', [
                    'model' => $model,
                    'permissions' => $permissions,
                    'permissionsArray' => $permissionsArray,
                    'identitiesArray' => $identitiesArray,
                    'customIdentitiesArray' => $customIdentitiesArray
                ]);
            }
            return $this->render('edit', [
                'model' => $model,
                'permissions' => $permissions,
                'permissionsArray' => $permissionsArray,
                'identitiesArray' => $identitiesArray,
                'customIdentitiesArray' => $customIdentitiesArray
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if(($model = User::findOne($id)) !== null) {
            return $model;
        }else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function performAjaxValidation($model) {
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
}
