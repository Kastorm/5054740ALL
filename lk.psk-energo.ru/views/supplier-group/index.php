<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SupplierGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Suppliers groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-group-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_menu'); ?>
    <p>
        <?=\app\widgets\ajaxControls\AjaxControls::widget([
            'createUrl'=>'/supplier-group/edit',
            'updateUrl'=>'/supplier-group/edit',
            'deleteUrl'=>'/supplier-group/delete',
            'indexUrl'=>'/supplier-group/index',
            'gridSelector'=>'#supplier-groups-grid',
            'formSelector'=>'#supplier-group-form',
        ]) ?>
    </p>
    <div class="clearfix"></div>
    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'supplier-groups-grid',
        'tableOptions' => [
            'class' => 'table table-striped table-bordered text-center',
        ],
        'columns' => [
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::tag('div', Html::tag('div', $model->title, ['style' => 'height: auto; width: 200px;']), ['style' => 'width: 200px; height: auto; overflow: hidden; text-align: left;']);
                }
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
