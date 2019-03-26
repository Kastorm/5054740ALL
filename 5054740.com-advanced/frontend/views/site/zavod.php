<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 25.03.2019
 * Time: 18:10
 */
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\models\Zavod;
$this->title = 'Все заводы - Рабочая таблица';
$this->params['breadcrumbs'][] = $this->title;
/* @var $this yii\web\View */
$this->title = 'Админ панель';
?>


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