<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SupplierGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>