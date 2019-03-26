<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\widgets\ajaxControls\AjaxControls;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TenderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tenders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tender-index">

    <h1><?= Html::encode($this->title) ?></h1>
<p>
    <?=AjaxControls::widget([
        'createUrl'=>'/tender/edit',
        'updateUrl'=>'/tender/edit',
        'deleteUrl'=>'/tender/delete',
        'indexUrl'=>'/tender/index',
        'gridSelector'=>'#tenders-grid',
        'formSelector'=>'#tender-form',
    ]) ?>
</p>
    <div class="clearfix"></div>
    <?php \yii\widgets\Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id'=>'tenders-grid',
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
                'attribute'=>'login',
                'length'=>15,
            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'password',
                'length'=>15,
            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'links',
                'length'=>35,

            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'description',
                'length'=>15,

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
