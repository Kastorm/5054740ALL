<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\grid\CheckboxColumn;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-index">



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'group',
            ['class' => 'yii\grid\ActionColumn'],
           
                      ],
        'responsive'=>true,
        'hover'=>true,

        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Countries</h3>',
            'type'=>'success',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Новая группа', ['create'], ['class' => 'btn btn-success']),
            'after'=>false,
            'footer'=>false
        ],

    ]); ?>
</div>
