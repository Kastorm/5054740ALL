<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Suppliers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_menu'); ?>

    <p>
        <?= \app\widgets\ajaxControls\AjaxControls::widget([
            'createUrl' => '/supplier/edit',
            'updateUrl' => '/supplier/edit',
            'deleteUrl' => '/supplier/delete',
            'indexUrl' => '/supplier/index',
            'mailingUrl' => '/site/mailing',
            'gridSelector' => '#suppliers-grid',
            'formSelector' => '#supplier-form',
            'customButtons' => [
                'mailing'
            ]
        ]) ?>
    </p>

    <div class="clearfix"></div>
    <?php \yii\widgets\Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'suppliers-grid',
        'tableOptions' => [
            'class' => 'table table-striped table-bordered text-center',
        ],
        'columns' => [
            [
                'class' => \yii\grid\CheckboxColumn::className(),
                'visible' => Yii::$app->user->can('site-mailing')
            ],
            [
                'attribute' => 'group_id',
                'value' => function ($model) {
                    return $model->groupName;
                }
            ],
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::tag('div', Html::tag('div', $model->title, ['style' => 'height: auto; width: 200px;']), ['style' => 'width: 200px; height: auto; overflow: hidden; text-align: left;']);
                }
            ],
            [
                'class' => '\app\components\DataColumn',
                'attribute' => 'inn',
            ],
            [
//                'class' => '\app\components\DataColumn',
                'attribute' => 'responsible',
            ],
            [
                'class' => '\app\components\DataColumn',
                'attribute' => 'phone',
            ],
            [
                'class' => '\app\components\DataColumn',
                'attribute' => 'address',
                'length' => 15,
            ],
            [
                'class' => '\app\components\DataColumn',
                'attribute' => 'comment',
                'length' => 12,
            ],
            [
                'class' => '\app\components\DataColumn',
                'attribute' => 'email',
                'length' => 20,
            ],
            [
                'attribute' => 'updated_by',
                'format' => 'raw',
                'value' => function ($model) {
                    return !is_null($model->updatedByUser) ?
                        ($model->updatedByUser->username . '<br>' . Yii::$app->formatter->asDate($model->updated_at))
                        : Yii::t('app', 'Not set');
                }
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>