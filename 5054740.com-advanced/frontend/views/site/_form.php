<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.03.2019
 * Time: 11:01
 */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="post">
    <h2><?= Html::encode($model->name) ?></h2>
    <?= ($model->groups->group) ?>
    <?= ($model->gorod->name) ?>




</div>