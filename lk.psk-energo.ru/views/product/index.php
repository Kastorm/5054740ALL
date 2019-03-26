<?php

use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<p>
        <?=\app\widgets\ajaxControls\AjaxControls::widget([
            'indexUrl' => 'product/index',
            'createUrl' => false,
            'updateUrl' => false,
            'deleteUrl' => false,
        	'gridSelector'=>'#product-grid',
        ]) ?>
	</p>

	<div class="clearfix"></div>

    <?php Pjax::begin([
        'id' => 'data-pjax-grid',
    ]); ?>
    <?= GridView::widget([
        'id'=>'product-grid',
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'columns' => [
            'id',
            'supplier.title',
            'supplier.city',
            'name',
            'size_l',
            'size_b',
            'size_h',
            'mark_b',
            'volume',
            'weight',
            'price_without_vat',
            'price_with_vat',
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
