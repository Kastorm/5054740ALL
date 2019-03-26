<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modal-content">
    <?php $form = ActiveForm::begin([
        'layout'=>'horizontal',
        'id' => 'user-form',
        'enableAjaxValidation' => true,
        'enableClientValidation'=>true,
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-4',
                'offset' => 'col-sm-offset-4',
                'wrapper' => 'col-sm-8 form-group',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]); ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?=$this->title ?></h4>
    </div>
    <div class="modal-body">

        <?php
        echo Tabs::widget([
            'items' => [
                [
                    'label' => Yii::t('app','General'),
                    'content' => $this->render('_general',[
                        'model'=>$model,
                        'form'=>$form
                    ]),
                    'active' => true
                ],
                [
                    'label' =>  Yii::t('app','Permissions'),
                    'content' => $this->render('_permissions',[
                        'model'=>$model,
                        'form'=>$form,
                        'permissions'=>$permissions,
                        'permissionsArray'=>$permissionsArray,
                        'identitiesArray'=>$identitiesArray,
                        'customIdentitiesArray' => $customIdentitiesArray
                    ]),
                ],
            ],
        ]);
        ?>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?=Yii::t('app', 'Close')?></button>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    </div>
    <?php ActiveForm::end(); ?>

</div>


