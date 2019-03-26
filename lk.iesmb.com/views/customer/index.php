<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\widgets\ajaxControls\AjaxControls;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TenderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tender-index">

    <h1><?= Html::encode($this->title) ?></h1>
<p>
    <?=AjaxControls::widget([
        'createUrl'=>'/customer/edit',
        'updateUrl'=>'/customer/edit',
        'deleteUrl'=>'/customer/delete',
        'indexUrl'=>'/customer/index',
        'gridSelector'=>'#customers-grid',
        'formSelector'=>'#customer-form',
    ]) ?>
</p>
    <div class="clearfix"></div>
    <?php \yii\widgets\Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id'=>'customers-grid',
        'tableOptions'=>[
            'class'=>'table table-striped table-bordered text-center',
        ],
        'columns' => [
            [
                'attribute'=>'title',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::tag('div',Html::tag('div',$model->title,['style'=>'height: auto; width: 200px;']),['style'=>'width: 200px; height: auto; overflow: hidden; text-align: left;']);
                }
            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'inn',
            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'site',
                'length'=>15,
            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'email',
                'length'=>20,
            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'address',
                'length'=>15,
            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'person',
                'length'=>12,
            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'phone',
            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'description',
                'length'=>12,
            ],
            [
                'attribute'=>'updated_by',
                'format'=>'raw',
                'value'=>function($model){
                    return !is_null($model->updatedByUser)?
                        ($model->updatedByUser->username.'<br>'.Yii::$app->formatter->asDate($model->updated_at))
                        :Yii::t('app','Not set');
                }
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>
