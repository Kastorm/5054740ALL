<?php

use yii\db\Migration;

/**
 * Class m180412_122316_import_settings
 */
class m180412_122316_import_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%import_settings}}', [
            'id' => $this->primaryKey()->unsigned(),
            'supplier_id' => $this->integer(10)
                ->unsigned()
                ->unique(),
            'settings' => $this->text()
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
        $this->createIndex('idx-import_settings-supplier', '{{%import_settings}}', 'supplier_id', true);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%import_settings}}');
    }
}
