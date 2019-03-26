<?php
use app\widgets\MainMenu;

/* @var $this yii\web\View */
$this->title = 'IESMB';
?>
<div id="home">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <?= MainMenu::widget();?>
        </div>
    </div>
</div>
