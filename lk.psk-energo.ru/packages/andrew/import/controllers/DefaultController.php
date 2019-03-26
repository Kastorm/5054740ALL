<?php

namespace andrew\import\controllers;

use andrew\import\components\ActiveDataProvider;
use andrew\import\components\Import;
use andrew\import\models\SettingForm;
use andrew\import\models\Settings;
use andrew\import\models\TmpData;
use andrew\import\models\UploadForm;
use yii\bootstrap\Html;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;
use yii\web\HttpException;
/**
 * Default controller for the `import` module
 */
class DefaultController extends Controller
{
    public $defaultAction = 'step1';

    public function beforeAction($action)
    {
        if(!Yii::$app->user->can('import')) {
            throw new HttpException(403, 'Access deny');
        }
        return parent::beforeAction($action);
    }

    public function actionStep1()
    {
        $uploadModel = new UploadForm();
        if (Yii::$app->request->isPost) {
            if (isset($_POST['UploadForm'])) {
                Yii::$app->session->set('import.step', 1);
                $uploadModel->setAttributes($_POST['UploadForm']);
                $uploadModel->file = UploadedFile::getInstance($uploadModel, 'file');
                $uploadResult = false;
                try {
                    $uploadResult = $uploadModel->upload();
                } catch (\Exception $ex) {
                    Yii::$app->session->setFlash('import.result', $ex->getMessage());
                }
                if ($uploadResult) {
                    Yii::$app->session->set('import.step', 2);
                    Yii::$app->session->set('import.supplier', $uploadModel->supplier);
                    Yii::$app->session->set('import.group', $uploadModel->group);
                    return $this->redirect('/import/default/step2');
                }
            }
        }

        return $this->render('step1', [
            'uploadModel' => $uploadModel,
        ]);
    }

    public function actionStep2()
    {
        if (!Yii::$app->session->has('import.step')
            || (Yii::$app->session->has('import.step')
                && Yii::$app->session->get('import.step') < 2)
        ) {
            return $this->redirect('step1');
        }
        $settingsModel = new Settings();
        $settingsForm = SettingForm::get(Yii::$app->session->get('import.supplier'));
        if (Yii::$app->request->isPost && $settingsForm->load(Yii::$app->request->post(), 'SettingForm')) {
            $result = false;
            try {
                $result = $settingsForm->set(Yii::$app->session->get('import.supplier'));
            } catch (\Exception $ex) {
                Yii::$app->session->setFlash('import.result', $ex->getMessage());
            }
            if ($result && $settingsForm->next) {
                Yii::$app->session->set('import.step', 3);

                return $this->redirect('/import/default/step3');
            }
        }
        $previewData = TmpData::find()
            ->where([
                'supplier_id' => Yii::$app->session->get('import.supplier'),
                //'group_id' => Yii::$app->session->get('import.group'),
                'session_id' => Yii::$app->session->id,
            ])
            ->orderBy('id')
            ->limit(10);
        if ($settingsForm->skipFirst) {
            $previewData = $previewData->offset(1);
        }
        $previewData = $previewData->all();

        return $this->render('step2', [
            'settingsForm' => $settingsForm,
            'settingsModel' => $settingsModel,
            'previewData' => $previewData,
            'limitColumnsTo' => Yii::$app->controller->module->limitColumnsTo,
        ]);
    }

    public function actionStep3()
    {
        if (!Yii::$app->session->has('import.step')
            || (Yii::$app->session->has('import.step')
                && Yii::$app->session->get('import.step') < 3)
        ) {
            return $this->redirect('step1');
        }
        $settings = SettingForm::get(Yii::$app->session->get('import.supplier'));
        $extraOffset = 0;
        if ($settings->skipFirst) {
            $extraOffset += 1;
        }
        $query = TmpData::find()
            ->where([
                'supplier_id' => Yii::$app->session->get('import.supplier'),
                //'group_id' => Yii::$app->session->get('import.group'),
                'session_id' => Yii::$app->session->id,
            ]);
        $columns = [];
        $firstRow = clone $query;
        $firstRowData = $firstRow->one();
        $priceModel = Yii::$app->controller->module->priceModel;
        $modelAttributeLabels = $priceModel->attributeLabels();
        foreach ($firstRowData->data as $k => $v) {
            if (array_key_exists($k, $settings->fields) && !empty($settings->fields[$k])) {
                $columns[] = [
                    'attribute' => 'data',
                    'label' => $modelAttributeLabels[$settings->fields[$k]],
                    'content' => function ($data) use ($k) {
                        return $data->data[$k];
                    },
                ];
            }
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 20],
            'extraOffset' => $extraOffset,
        ]);
        $columns[] = [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{exclude}{include}',
            'contentOptions' => ['style' => 'width:50px;'],
            'buttons' => [
                'exclude' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'data-action' => 'exclude',
                        'title' => 'Исключить из импорта',
                        'style' => $model->deleted
                            ? 'display:none;'
                            : '',
                    ]);
                },
                'include' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-open"></span>', $url, [
                        'data-action' => 'include',
                        'title' => 'Включить в импорт',
                        'style' => $model->deleted
                            ? ''
                            : 'display:none;',
                    ]);
                },
            ],
        ];

        return $this->render('step3', [
            'columns' => $columns,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionExclude($id)
    {
        TmpData::updateAll(['deleted' => 1], ['id' => $id]);
    }

    public function actionInclude($id)
    {
        TmpData::updateAll(['deleted' => 0], ['id' => $id]);
    }

    public function actionStart()
    {
        
        if (!Yii::$app->session->has('import.step')
            || (Yii::$app->session->has('import.step')
                && Yii::$app->session->get('import.step') < 3)
        ) {
            return $this->redirect('step1');
        }

        return $this->renderPartial('result', ['result' => Import::import()]);
    }
}
