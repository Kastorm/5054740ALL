<?php

use yii\db\Schema;
use yii\db\Migration;

class m150627_034110_remove_column_from_tender extends Migration
{
    public function up()
    {
        $this->dropColumn('tender','phone');
    }

    public function down()
    {
        return false;
    }
    

}
