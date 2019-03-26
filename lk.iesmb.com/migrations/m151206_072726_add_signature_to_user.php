<?php

use yii\db\Schema;
use yii\db\Migration;

class m151206_072726_add_signature_to_user extends Migration
{

    public function safeUp()
    {
        $this->addColumn('user','signature',\yii\db\cubrid\Schema::TYPE_TEXT);
    }

    public function safeDown()
    {
        $this->dropColumn('user','signature');
    }
}
