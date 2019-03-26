<?php

use yii\db\Schema;
use yii\db\Migration;

class m150617_171752_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tender}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' not null',
            'phone'=> Schema::TYPE_STRING . '  not null',
            'login'=> Schema::TYPE_STRING . ' null default null',
            'password' => Schema::TYPE_STRING . ' null default null',
            'links'=> Schema::TYPE_STRING . ' null default null',
            'description'=> Schema::TYPE_STRING . ' null default null',
            'updated_at' => Schema::TYPE_INTEGER . ' null default null',
            'created_at' => Schema::TYPE_INTEGER . ' null default null',
            'created_by' => Schema::TYPE_INTEGER . ' null default null',
            'updated_by' => Schema::TYPE_INTEGER . ' null default null',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%tender}}');
    }
}
