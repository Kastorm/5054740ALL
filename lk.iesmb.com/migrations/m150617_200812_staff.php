<?php

use yii\db\Schema;
use yii\db\Migration;

class m150617_200812_staff extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%staff}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' not null',
            'name'=> Schema::TYPE_STRING . '  not null',
            'email'=> Schema::TYPE_STRING . '  not null',
            'address'=> Schema::TYPE_STRING . '  not null',
            'phone'=> Schema::TYPE_STRING . '  not null',
            'description'=> Schema::TYPE_TEXT . ' null default null',
            'updated_at' => Schema::TYPE_INTEGER . ' null default null',
            'created_at' => Schema::TYPE_INTEGER . ' null default null',
            'created_by' => Schema::TYPE_INTEGER . ' null default null',
            'updated_by' => Schema::TYPE_INTEGER . ' null default null',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%staff}}');
    }
}
