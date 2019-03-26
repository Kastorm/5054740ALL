<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

?>

    <?=
    ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_form',
    ]);
    ?>




    <code><?= __FILE__ ?></code>
</div>
