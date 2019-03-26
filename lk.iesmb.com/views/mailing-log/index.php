<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MailingLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mailing log');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailing-log-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_menu'); ?>
    <p>
        <?= \app\widgets\ajaxControls\AjaxControls::widget([
            'createUrl' => '/mailing-log/edit',
            'updateUrl' => '/mailing-log/edit',
            'deleteUrl' => '/mailing-log/delete',
            'indexUrl' => '/mailing-log/index',
            'gridSelector' => '#mailing-log-grid',
            'formSelector' => '#mailing-log-form',
        ]) ?>
    </p>

    <div class="clearfix"></div>
    <?php \yii\widgets\Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'mailing-log-grid',
        'tableOptions' => [
            'class' => 'table table-striped table-bordered text-center',
        ],
        'columns' => [
            [
                'attribute' => 'user_from',
            ],
            [
                'attribute' => 'email_from',
            ],
            [
                'attribute' => 'email_to',
            ],
            [
                'attribute' => 'body',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::tag('div', Html::tag('div', Html::a($model->body, ['#'], ['class' => 'full-body']), [
                        'style' => 'max-height: 50px; width: 200px;'
                    ]), [
                        'style' => 'width: 200px; max-height: 50px; overflow: hidden; text-align: left;'
                    ]);
                }
            ],
            [
                'attribute' => 'created_by',
                'format' => 'raw',
                'value' => function ($model) {
                    $value = !is_null($model->createdByUser) ?
                        ($model->createdByUser->username . ' - ' . Yii::$app->formatter->asDate($model->created_at))
                        : Yii::t('app', 'Not set');
                    return '<div style="width: 150px;">' . $value . '</div>';
                }
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
<?php Yii::$app->view->registerJs('
    $("body").on("click", ".full-body", function () {
        var body = $(this).html();
        $("#fullBody .modal-body").html(body);
        $("#fullBody").modal("show");
        return false;
    });
'); ?>
<div class="modal fade" id="fullBody" tabindex="-1" role="dialog" aria-labelledby="fullBodyLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="fullBodyLabel">Просмотр текста письма</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
            </div>
        </div>
    </div>
</div>