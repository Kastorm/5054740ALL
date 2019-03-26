<?php if (array_key_exists('error', $result)) { ?>
    Ошибка импорта:
    <br>
    <br>
    <?= nl2br($result['error']) ?>
<?php } else { ?>
    Импорт завершен, добавлено записей <?= $result['total'] ?>
<?php } ?>
<br>
<br>
<button class="btn btn-info" data-toggle="modal" data-target="#modal">Ok</button>
