<?php

use yii\db\Schema;
use yii\db\Migration;

class m150926_224742_mailing_log extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%mailing_log}}', [
            'id' => Schema::TYPE_PK,
            'user_from' => Schema::TYPE_STRING . ' not null',
            'email_from' => Schema::TYPE_STRING . ' not null',
            'email_to' => Schema::TYPE_STRING . ' not null',
            'body' => Schema::TYPE_TEXT . ' null default null',
            'updated_at' => Schema::TYPE_INTEGER . ' null default null',
            'created_at' => Schema::TYPE_INTEGER . ' null default null',
            'created_by' => Schema::TYPE_INTEGER . ' null default null',
            'updated_by' => Schema::TYPE_INTEGER . ' null default null',
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%mailing_log}}');

        return true;
    }
}