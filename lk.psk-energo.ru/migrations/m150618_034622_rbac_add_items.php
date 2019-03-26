<?php

use yii\db\Schema;
use yii\db\Migration;

class m150618_034622_rbac_add_items extends Migration
{

    public function safeUp()
    {
        $this->insert('auth_item',[
            'name'=>'user-admin-delete',
            'description'=>'Удаление пользователей',
            'type'=>2,
            'created_at'=>time(),
            'updated_at'=>time(),
        ]);
        $this->insert('auth_item',[
            'name'=>'user-admin-edit',
            'description'=>'Редактирование пользователей',
            'type'=>2,
            'created_at'=>time(),
            'updated_at'=>time(),
        ]);
        $this->insert('auth_item',[
            'name'=>'user-admin-index',
            'description'=>'Просмотр пользователей',
            'type'=>2,
            'created_at'=>time(),
            'updated_at'=>time(),
        ]);

        $this->insert('auth_item',[
            'name'=>'tender-delete',
            'description'=>'Удаление тендеров',
            'type'=>2,
            'created_at'=>time(),
            'updated_at'=>time(),
        ]);
        $this->insert('auth_item',[
            'name'=>'tender-edit',
            'description'=>'Редактирование тендеров',
            'type'=>2,
            'created_at'=>time(),
            'updated_at'=>time(),
        ]);
        $this->insert('auth_item',[
            'name'=>'tender-index',
            'description'=>'Просмотр тендеров',
            'type'=>2,
            'created_at'=>time(),
            'updated_at'=>time(),
        ]);

        $this->insert('auth_item',[
            'name'=>'customer-delete',
            'description'=>'Удаление заказчиков',
            'type'=>2,
            'created_at'=>time(),
            'updated_at'=>time(),
        ]);
        $this->insert('auth_item',[
            'name'=>'customer-edit',
            'description'=>'Редактирование заказчиков',
            'type'=>2,
            'created_at'=>time(),
            'updated_at'=>time(),
        ]);
        $this->insert('auth_item',[
            'name'=>'customer-index',
            'description'=>'Просмотр заказчиков',
            'type'=>2,
            'created_at'=>time(),
            'updated_at'=>time(),
        ]);

        $this->insert('auth_item',[
            'name'=>'staff-delete',
            'description'=>'Удаление сотрудников',
            'type'=>2,
            'created_at'=>time(),
            'updated_at'=>time(),
        ]);
        $this->insert('auth_item',[
            'name'=>'staff-edit',
            'description'=>'Редактирование сотрудников',
            'type'=>2,
            'created_at'=>time(),
            'updated_at'=>time(),
        ]);
        $this->insert('auth_item',[
            'name'=>'staff-index',
            'description'=>'Просмотр сотрудников',
            'type'=>2,
            'created_at'=>time(),
            'updated_at'=>time(),
        ]);
    }

    public function safeDown()
    {
    }
}