<?php

use yii\db\Schema;
use yii\db\Migration;

class m150627_093430_delete_field_name_from_user extends Migration
{
    public function up()
    {
        $this->dropColumn('user','name');
    }

    public function down()
    {
        return false;
    }
}
