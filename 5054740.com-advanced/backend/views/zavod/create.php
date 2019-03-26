<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Zavod */

$this->title = 'Create Zavod';
$this->params['breadcrumbs'][] = ['label' => 'Zavods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zavod-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
