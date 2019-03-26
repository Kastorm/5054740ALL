<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property int $groupID
 * @property int $parentID
 * @property string $name
 * @property string $url
 * @property int $done
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parentID', 'name', 'url'], 'required'],
            [['parentID', 'done'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'groupID' => 'Group ID',
            'parentID' => 'Parent ID',
            'name' => 'Name',
            'url' => 'Url',
            'done' => 'Done',
        ];
    }
}
