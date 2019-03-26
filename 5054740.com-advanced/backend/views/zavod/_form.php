<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\Zavod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zavod-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'group_id')->widget(Select2::classname(), [
    'data' =>\yii\helpers\ArrayHelper::map( \common\models\Group::find()->all(),'id','group'),
    'language' => 'ru',
    'options' => ['placeholder' => 'Выбрать группу....'],
    'pluginOptions' => [
    'allowClear' => true
    ],
    ]);
    ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inn')->textInput() ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'id_city')->widget(Select2::classname(), [
        'data' =>\yii\helpers\ArrayHelper::map( \common\models\City::find()->all(),'id','name'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выбрать город....'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?/*= $form->field($model, 'status')->dropDownList(\common\models\Zavod::getStatusList())*/ ?>
    <?=$form->field($model, 'status')->widget(Select2::classname(), [
        'name' => 'status',
        'hideSearch' => true,
        'data' =>[1 => 'Действует', 0 => 'Закрылся'],
        'language' => 'ru',
        'options' => ['placeholder' => 'Выбрать статус....'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>


    <?= $form->field($model, 'adres')->textInput(['maxlength' => true]) ?>

    <?=  $form->field($model, 'coment')->widget(Widget::className(), [
    'settings' => [
    'lang' => 'ru',
    'minHeight' => 200,
    'plugins' => [
    'clips',
    'fullscreen',
    ],
    ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
