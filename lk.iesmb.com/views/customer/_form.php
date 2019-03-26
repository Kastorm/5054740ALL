<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tender */
/* @var $form yii\widgets\ActiveForm */
?>
<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'person')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>


