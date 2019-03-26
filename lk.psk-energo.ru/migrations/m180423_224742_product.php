<?php

use yii\db\Schema;
use yii\db\Migration;

class m150926_224742_mailing_log extends Migration
{
    public function safeUp()
    {
/*

create table product
(
	id int(10) unsigned auto_increment
		primary key,
	supplier_id int(11) null,
	group_id int(11) null,
	name varchar(255) null,
	size_l varchar(255) null,
	size_b varchar(255) null,
	size_h varchar(255) null,
	mark_b varchar(255) null,
	volume varchar(255) null,
	weight varchar(255) null,
	price_without_vat decimal null,
	price_with_vat decimal null
) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB
;

create index `fk_product-group`
	on product (group_id)
;

create index `fk_product-supplier`
	on product (supplier_id)
;

ALTER TABLE product
ADD CONSTRAINT product_supplier_id_fk
FOREIGN KEY (supplier_id) REFERENCES supplier (id);

ALTER TABLE product
ADD CONSTRAINT product_supplier_group_id_fk
FOREIGN KEY (group_id) REFERENCES supplier_group (id);


 */
    }

    public function safeDown()
    {

        return true;
    }
}
