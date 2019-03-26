<?php

use yii\db\Schema;
use yii\db\Migration;

class m150926_190251_rbac_add_items_for_mailing extends Migration
{
    public function safeUp()
    {
        $this->insert('auth_item', [
            'name' => 'site-mailing',
            'description' => 'Email рассылка',
            'type' => 2,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function safeDown()
    {
    }
}