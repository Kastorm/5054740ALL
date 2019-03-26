<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MailingForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Mailing');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-mailing">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
        'id' => 'mailing-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-3',
                'offset' => 'col-sm-offset-4',
                'wrapper' => 'col-sm-8 form-group',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]); ?>
        <?= $form->field($model, 'suppliers')
            ->widget(
                \app\widgets\chosen\Chosen::className(), [
                'items' => $model->suppliersArray,
                'multiple' => true,
                'translateCategory' => 'app',
                'clientOptions' => [
                    'search_contains' => true,
                    'single_backstroke_delete' => false,
                ],
            ]); ?>
        <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
        <div class="form-group">
            <label class="control-label col-sm-3">Обозначения</label>
            <div class="col-sm-8 form-group legend">
                <div class="row">
                    <div class="col-sm-6">
                        <h5>Данные поставщика</h5>
                        <ul>
                            <li>{title} - Название поставщика</li>
                            <li>{inn} - ИНН поставщика</li>
                            <li>{responsible} - Ответственный</li>
                            <li>{phone} - Телефон поставщика</li>
                            <li>{email} - Email поставщика</li>
                            <li>{address} - Адреса поставщика</li>
                            <li>{comment} - Комментарий</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <h5>Данные отправителя</h5>
                        <ul>
                            <li>{username_from} - Имя отправителя</li>
                            <li>{email_from} - Email отправителя</li>
                            <li>{phone_from} - Телефон отправителя</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?= $form->field($model, 'body')->widget(\yii\redactor\widgets\Redactor::className([
            'clientOptions'=>[
                'buttons'=>[
                    'format', 'bold', 'italic', 'deleted', 'lists',
                    'link', 'horizontalrule'
                ]
            ]
        ])) ?>

   <div id="attachments">

       <div class="col-sm-8 col-sm-offset-3 form-group" id="blank-file-item" style="display: none">
           <a href="#" class="btn btn-danger btn-xs remove"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a><?= Html::activeFileInput($model,'attachments[]') ?>
       </div>

       <label class="control-label col-sm-3">Прикрепленные файлы</label>

       <div id="items" class="col-sm-8">

       </div>

       <div class="col-sm-8 col-sm-offset-3">
           <a href="#" class="btn btn-info btn-sm add">Добавить</a>
       </div>
   </div>

    <div class="form-group">
            <label class="control-label col-sm-3"></label>
            <div class="col-sm-8 form-group">
                <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-success pull-right']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>



<style>
    #attachments .remove{
        float: left;
    }
</style>

<?php
$this->registerJs("
$('#attachments').on('click','.remove',function(){
    $(this).parent().remove();
    return false;
});
$('#attachments').on('click','.add',function(){
    var item = $('#blank-file-item').clone().show();
    $('#items').append(item);

    return false;
});
");

?>