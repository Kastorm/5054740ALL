<?php

namespace app\controllers;

use app\models\MailingForm;
use app\modules\user\components\RbacFilter;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Response;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index'],
                'rules' => [
                    [
                        'actions' => ['logout','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'rbac' => [
                'class' => RbacFilter::className(),
                'allow' => [
                    'site-index',
                    'site-error',
                    'site-captcha',
                ]
            ]
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @param $selection
     * @return string
     */
    public function actionMailing($selection)
    {
        $selectionIds = Json::decode($selection);
        $model = new MailingForm();
        $model->suppliers = $selectionIds;

        if ($errors = $this->performAjaxValidation($model)) {
            return $errors;
        }

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->sendEmails()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'All messages was send'));
                return $this->refresh();
            }else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Messages sending error'));
            }
        }

        return $this->render('mailing', [
            'model' => $model
        ]);
    }

    protected function performAjaxValidation($model)
    {
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
}