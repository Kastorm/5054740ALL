<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $form->field($model, 'group_id')->dropDownList($model->groups, ['prompt' => '-- Выберите группу --']) ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'responsible')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => ['+79999999999']
]); ?>

<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'city')->dropDownList(array_combine(\Yii::$app->params['cities'], \Yii::$app->params['cities']), ['prompt' => '-- Выберите город --']) ?>

<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>