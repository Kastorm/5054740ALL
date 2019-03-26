<?php

use yii\widgets\ActiveForm;
use andrew\import\components\AppHelper;
use yii\widgets\Pjax;

/** @var \yii\web\View $this */
/** @var \andrew\import\models\Settings $settingsModel */
/** @var \andrew\import\models\SettingForm $settingsForm */
/** @var \andrew\import\models\Settings $previewData [] */

$this->registerJS(<<<JS
    $(document).on('change', '.active-control', function() {
        $('step2').submit();
    });
	$(document).on('click', '.next', function(){
	    $('#settingform-next').val(1);
	});
JS
);
$n = 0;
?>

<h2>Предпросмотр</h2>
<?php Pjax::begin(['id' => 'options']); ?>
<?php if (Yii::$app->session->has('import.result')) { ?>
	<div class="alert alert-danger" role="alert">
        <?= Yii::$app->session->get('import.result') ?>
        <?php Yii::$app->session->remove('import.result'); ?>
	</div>
<?php } ?>
<div class="row">
    <?php $form = ActiveForm::begin([
        'id' => 'step2',
        'options' => ['data-pjax' => true],
        'fieldConfig' => ['template' => "{input}"],
    ]) ?>
    <?= $form->field($settingsForm, 'next')
        ->hiddenInput() ?>
    <?= $form->field($settingsForm, 'skipFirst', [
        'template' => '<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>',
    ])
        ->checkbox([
            'class' => 'active-control form-control',
        ]) ?>
    <?= $form->field($settingsForm, 'rewrite', [
        'template' => '<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>',
    ])
        ->checkbox([
            'class' => 'active-control form-control',
        ]) ?>
	<div style="width:1200px;overflow-x: auto;">
		<table class="table" style="max-width: none;table-layout: fixed;">
			<thead>
			<tr>
                <?php
                $keys = AppHelper::arrayFillLetters();
                $totalColumns = count($previewData[0]->data);
                for ($i = 0; ($i < $totalColumns && $i < count($keys)); $i++) {
                    $key = $keys[$i];
                    $value = array_key_exists($key, $settingsForm->fields)
                        ? $settingsForm->fields[$key]
                        : null;
                    ?>
					<td style="width:200px;">
                        <?= $form->field($settingsForm, "fields[{$key}]")
                            ->dropDownList(AppHelper::arrayPrependEmpty($settingsForm->getFieldsList()),
                                ['value' => $value, 'class' => 'active-control form-control'])
                            ->label(false) ?>
                        <?php $n++; ?>
					</td>
                <?php } ?>
			</tr>
			</thead>
			<tbody>
            <?php
            $limitColumns = count($keys);
            foreach ($previewData as $row) {
                $columnsCounter = 0;
                ?>
				<tr>
                    <?php foreach ($row->data as $field) { ?>
						<td>
                            <?= $field ?>
						</td>
                        <?php
                        if ($columnsCounter++ >= $limitColumns - 1) {
                            break;
                        }
                    } ?>
				</tr>
            <?php } ?>
			</tbody>
		</table>
	</div>
	<div>
		<a href="<?= \yii\helpers\Url::to('step1') ?>" class="btn btn-success">< Предыдущий шаг</a>
		<button class="btn btn-success next">Следующий шаг ></button>
	</div>
    <?php ActiveForm::end() ?>
</div>
<?php Pjax::end(); ?>
