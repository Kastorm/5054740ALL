<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ZavosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $generator yii\gii\generators\crud\Generator */
/* @var $model \yii\db\ActiveRecord */



$this->title = 'Zavods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zavod-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Zavod', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute'=>'group_id','value'=>'groups.group'],
            'name',
            ['attribute'=>'id_city','value'=>'gorod.name'],
            'inn',
            'tel',
            'email:email',
            'url:url',
            ['attribute'=>'status', 'filter'=>\common\models\Zavod::getStatusList(),'value'=>'StatusName'],
            'adres',
            //'coment:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
