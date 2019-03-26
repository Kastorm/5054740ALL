<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.03.2019
 * Time: 11:56
 */
use yii\helpers\Html;
use yii\widgets\Pjax;
$this->title = 'Заводы вариант 1';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php Pjax::begin(); ?>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">№</th>
        <th scope="col">Город</th>
        <th scope="col">Группа</th>
        <th scope="col">Название</th>
        <th scope="col">Действует</th>
        <th scope="col">ИНН</th>
        <th scope="col">Email</th>
    </tr>
    </thead>

    <tbody>
    <? foreach ($zavods as $one): ?>
        <tr>
            <th scope="row"><?=$one->id?></th>
            <td><?=$one->gorod->name?></td>
            <td><?=$one->groups->group?></td>
            <td> <?=$one->name?></td>
            <td> <?=$one->StatusName?></td>
            <td> <?=$one->inn?></td>
            <td> <?=$one->email?></td>
        </tr>
    <?php endforeach;  ?>
    </tbody>
</table>
<?php Pjax::end(); ?>