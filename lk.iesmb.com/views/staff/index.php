<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\widgets\ajaxControls\AjaxControls;
use app\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TenderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Staff');
$this->params['breadcrumbs'][] = $this->title;

ini_set('default_charset', 'UTF-8');
mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');
?>
<div class="tender-index">

    <h1><?= Html::encode($this->title) ?></h1>
<p>
    <?=AjaxControls::widget([
        'createUrl'=>'/staff/edit',
        'updateUrl'=>'/staff/edit',
        'deleteUrl'=>'/staff/delete',
        'indexUrl'=>'/staff/index',
        'gridSelector'=>'#staffs-grid',
        'formSelector'=>'#staff-form',
    ]) ?>
</p>
    <div class="clearfix"></div>
    <?php \yii\widgets\Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id'=>'staffs-grid',
        'tableOptions'=>[
            'class'=>'table table-striped table-bordered text-center',
        ],
        'columns' => [
            [
               'class'=>'\app\components\DataColumn',
               'attribute'=>'title',
               'length'=>20,
            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'name',
                'length'=>15,
            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'email',
                'length'=>15,

            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'address',
                'length'=>15,
            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'phone',
                'length'=>12,
            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'description',
                'length'=>30,
            ],
            [
                'attribute'=>'updated_by',
                'format'=>'raw',
                'value'=>function($model){
                    return !is_null($model->updatedByUser)?
                        ($model->updatedByUser->username.' '.Yii::$app->formatter->asDate($model->updated_at))
                        :Yii::t('app','Not set');
                }
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>
