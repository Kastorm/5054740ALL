<?php

use yii\db\Schema;
use yii\db\Migration;

class m150924_160200_supplier extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%supplier_group}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' not null',
            'updated_at' => Schema::TYPE_INTEGER . ' null default null',
            'created_at' => Schema::TYPE_INTEGER . ' null default null',
            'created_by' => Schema::TYPE_INTEGER . ' null default null',
            'updated_by' => Schema::TYPE_INTEGER . ' null default null',
        ], $tableOptions);

        $this->createTable('{{%supplier}}', [
            'id' => Schema::TYPE_PK,
            'group_id' => Schema::TYPE_INTEGER . ' not null',
            'title' => Schema::TYPE_STRING . ' not null',
            'inn' => Schema::TYPE_STRING . ' not null',
            'responsible' => Schema::TYPE_STRING . ' not null',
            'phone' => Schema::TYPE_STRING . ' not null',
            'address' => Schema::TYPE_STRING . ' not null',
            'comment' => Schema::TYPE_TEXT . ' null default null',
            'email' => Schema::TYPE_STRING . '  not null',
            'updated_at' => Schema::TYPE_INTEGER . ' null default null',
            'created_at' => Schema::TYPE_INTEGER . ' null default null',
            'created_by' => Schema::TYPE_INTEGER . ' null default null',
            'updated_by' => Schema::TYPE_INTEGER . ' null default null',
        ], $tableOptions);
    }
    
    public function safeDown()
    {
        $this->dropTable('{{%supplier}}');
        $this->dropTable('{{%supplier_group}}');

        return true;
    }
}
