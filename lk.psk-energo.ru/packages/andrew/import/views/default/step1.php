<?php

use yii\widgets\ActiveForm;
use andrew\import\components\AppHelper;

/** @var \yii\web\View $this */
/** @var \andrew\import\models\UploadForm $uploadModel */

$this->registerJS(<<<JS

JS
);

?>

<?php if (Yii::$app->session->has('import.result')) { ?>
	<div class="alert alert-danger" role="alert">
        <?= Yii::$app->session->get('import.result') ?>
        <?php Yii::$app->session->remove('import.result'); ?>
	</div>
<?php } ?>

<?php $form = ActiveForm::begin(['id' => 'upload', 'options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($uploadModel, 'file')
    ->fileInput() ?>


<?= $form->field($uploadModel, 'supplier')
    ->dropDownList(AppHelper::arrayPrependEmpty($uploadModel->getSupplierList())) ?>

<?= $form->field($uploadModel, 'group')
    ->dropDownList(AppHelper::arrayPrependEmpty($uploadModel->getGroupList())) ?>

<button class="btn btn-success">Следующий шаг ></button>

<?php ActiveForm::end() ?>
