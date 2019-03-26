<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MailingLog */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $form->field($model, 'user_from')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'email_from')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'email_to')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>