<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MailingLog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mailing Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailing-log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_from',
            'email_from:email',
            'email_to:email',
            'body:ntext',
            'updated_at',
            'created_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
