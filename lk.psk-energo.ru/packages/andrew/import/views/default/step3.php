<?php

use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/** @var \yii\web\View $this */

$startUrl = Url::to('/import/default/start');

$this->registerJS(<<<JS
$(document).on('click', '*[data-action="include"],*[data-action="exclude"]', function(){
	$.ajax($(this).attr('href'), {
        type: 'POST'
    }).done(function(data) {
        $.pjax.reload({container: '#data-pjax-grid'});
    });
    return false;
});

$(document).on('click', '#start', function(){
    $('#modal').find('.modal-body').html('Импорт начат.');
    $.ajax('{$startUrl}', {}).done(function(data){
        console.log(data);
        $('#modal').find('.modal-body').html(data);
        $('#modal').modal('show');
    });
});
JS
);
$n = 0;
?>

<h2>Импорт</h2>

<?php Pjax::begin([
    'id' => 'data-pjax-grid',
]); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $columns,
    'rowOptions' => function ($model) {
        if ($model->deleted) {
            return ['class' => 'danger'];
        }
    },
]); ?>
<?php Pjax::end(); ?>

<div>
	<a href="<?= \yii\helpers\Url::to('step2') ?>" class="btn btn-success">< Предыдущий шаг</a>
	<button class="btn btn-success" id="start" data-toggle="modal" data-target="#modal">Импорт</button>
</div>

<?php Modal::begin([
    'id' => 'modal',
	'header' => '<h3>Импорт</h3>',
]);
Modal::end();
?>
