<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\user\models\User;
use app\widgets\ajaxControls\AjaxControls;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>

        <?=AjaxControls::widget([
            'createUrl'=>'/user/admin/edit',
            'updateUrl'=>'/user/admin/edit',
            'deleteUrl'=>'/user/admin/delete',
            'indexUrl'=>'/user/admin/index',
            'gridSelector'=>'#users-grid',
            'formSelector'=>'#user-form',
        ]) ?>
    </p>


    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id'=>'users-grid',
        'tableOptions'=>[
            'class'=>'table table-striped table-bordered text-center',
        ],
        'columns' => [
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'username',
                'length'=>25,
            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'email',
                'length'=>25,
            ],
            [
                'class'=>'\app\components\DataColumn',
                'attribute'=>'phone',
                'length'=>25,
            ],
            [
                'attribute'=>'status',
                'filter' => User::getStatuses(),
                'value'=>'statusTitle',
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


