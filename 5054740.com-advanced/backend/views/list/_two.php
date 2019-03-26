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

<tr>
    <th scope="row">№<?= ($model->id) ?>-</th>
    </td> <?= ($model->groups->group) ?>-</td>
    <td><?= ($model->gorod->name) ?>-</td>
    <td> <?= ($model->name) ?>-</td>
    <td> <?= ($model->status) ?>-</td>
    <td><?= ($model->inn)?>-</td>
    <td><?= ($model->email)?></td>
</tr>

