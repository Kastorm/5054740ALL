<?php

use yii\db\Schema;
use yii\db\Migration;
use app\modules\user\models\User;

class m150611_094934_user_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'status' => Schema::TYPE_SMALLINT . ' not null',
            'email' => Schema::TYPE_STRING . ' null default null',
            'username' => Schema::TYPE_STRING . ' null default null',
            'phone'=> Schema::TYPE_STRING . ' null default null',
            'password_hash' => Schema::TYPE_STRING . ' null default null',
            'password_reset_token'=> Schema::TYPE_STRING . ' null default null',
            'auth_key' => Schema::TYPE_STRING . ' null default null',
            'created_at' => Schema::TYPE_INTEGER . ' null default null',
            'updated_at' => Schema::TYPE_INTEGER . ' null default null',
            'created_by' => Schema::TYPE_INTEGER . ' null default null',
            'updated_by' => Schema::TYPE_INTEGER . ' null default null',
        ], $tableOptions);

        $security = Yii::$app->security;
        $columns = ['email', 'username', 'password_hash', 'status', 'auth_key'];
        $this->batchInsert('{{%user}}', $columns, [
            [
                'admin@admin.com',
                'admin',
                '$2y$13$dyVw4WkZGkABf2UrGWrhHO4ZmVBv.K4puhOL59Y9jQhIdj63TlV.O',
                User::STATUS_ACTIVE,
                $security->generateRandomString(),
            ],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }

}
