<?php

use yii\db\Schema;
use yii\db\Migration;

class m150926_173922_rbac_add_items_for_supplier extends Migration
{
    public function safeUp()
    {
        $this->insert('auth_item', [
            'name' => 'supplier-group-delete',
            'description' => 'Удаление групп поставщиков',
            'type' => 2,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        $this->insert('auth_item', [
            'name' => 'supplier-group-edit',
            'description' => 'Редактирование групп поставщиков',
            'type' => 2,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        $this->insert('auth_item', [
            'name' => 'supplier-group-index',
            'description' => 'Просмотр групп поставщиков',
            'type' => 2,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->insert('auth_item', [
            'name' => 'supplier-delete',
            'description' => 'Удаление поставщиков',
            'type' => 2,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        $this->insert('auth_item', [
            'name' => 'supplier-edit',
            'description' => 'Редактирование поставщиков',
            'type' => 2,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        $this->insert('auth_item', [
            'name' => 'supplier-index',
            'description' => 'Просмотр поставщиков',
            'type' => 2,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
   }

    public function safeDown()
    {
    }
}