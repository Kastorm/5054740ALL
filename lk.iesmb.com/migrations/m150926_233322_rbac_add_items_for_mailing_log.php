<?php

use yii\db\Schema;
use yii\db\Migration;

class m150926_233322_rbac_add_items_for_mailing_log extends Migration
{
    public function safeUp()
    {
        $this->insert('auth_item', [
            'name' => 'mailing-log-delete',
            'description' => 'Удаление записей лога рассылки',
            'type' => 2,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        $this->insert('auth_item', [
            'name' => 'mailing-log-edit',
            'description' => 'Редактирование записей лога рассылки',
            'type' => 2,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        $this->insert('auth_item', [
            'name' => 'mailing-log-index',
            'description' => 'Просмотр записей лога рассылки',
            'type' => 2,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function safeDown()
    {
        return true;
    }
}
