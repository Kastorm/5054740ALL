<br>
<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'value'=>'']) ?>
<?= $form->field($model, 'confirmPassword')->passwordInput(['maxlength' => true, 'value'=>'']) ?>
<?= $form->field($model, 'status')->dropDownList($model->getStatuses()) ?>
<?= $form->field($model, 'signature')->textarea() ?>
