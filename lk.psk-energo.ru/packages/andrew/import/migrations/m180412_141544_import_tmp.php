<?php

use yii\db\Migration;

/**
 * Class m180412_141544_import_tmp
 */
class m180412_141544_import_tmp extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%import_tmp}}', [
            'id' => $this->primaryKey()->unsigned(),
            'supplier_id' => $this->integer(10)
                ->unsigned(),
            'group_id' => $this->integer(10)
                ->unsigned(),
            'session_id' => $this->string()
                ->notNull(),
            'date' => $this->date(),
            'deleted' => $this->tinyInteger(1)
                ->notNull()
                ->defaultValue(0),
            'data' => $this->text()
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
        $this->createIndex('idx-import_tmp-', '{{%import_tmp}}', 'supplier_id,group_id,session_id');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%import_tmp}}');
    }
}
