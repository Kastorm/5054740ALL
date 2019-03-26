<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заводы вариант 2';
$this->params['breadcrumbs'][] = $this->title;

?>
<h1><?= Html::encode($this->title) ?></h1>
<?php Pjax::begin(); ?>
<?=
ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_two',
]);
?>







    <code><?= __FILE__ ?></code>
</div>
<?php Pjax::end(); ?>