<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 13.06.15
 * Time: 16:32
 * To change this template use File | Settings | File Templates.
 */

namespace app\modules\user\components;

use Yii;
use yii\rbac\Assignment;


class DbManager extends \dektrium\rbac\components\DbManager{

    public function assign($role, $userId)
    {
        if(is_object($role)){
            return parent::assign($role, $userId);
        }
        $assignment = new Assignment([
            'userId' => $userId,
            'roleName' => $role,
            'createdAt' => time(),
        ]);

        $this->db->createCommand()
            ->insert($this->assignmentTable, [
                'user_id' => $assignment->userId,
                'item_name' => $assignment->roleName,
                'created_at' => $assignment->createdAt,
            ])->execute();

        return $assignment;

    }

    public function checkAccess($userId, $permissionName, $params = [])
    {
        if(!Yii::$app->user->isGuest && in_array(Yii::$app->user->identity->username,Yii::$app->getModule('rbac')->admins)){
            return true;
        }
        if(strpos($permissionName,'/') !== false){
            $permissionName = trim(str_replace('/','-',$permissionName),'-');
        }
        return parent::checkAccess($userId, $permissionName, $params);
    }
}