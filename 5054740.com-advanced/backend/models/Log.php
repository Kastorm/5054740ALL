<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property int $id
 * @property string $data
 * @property string $log
 * @property string $ip
 * @property string $url
 * @property int $user_id
 */
class log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data', 'log', 'ip', 'url', 'user_id'], 'required'],
            [['data'], 'safe'],
            [['user_id'], 'integer'],
            [['log'], 'string', 'max' => 150],
            [['ip'], 'string', 'max' => 17],
            [['url'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Дата',
            'log' => 'Запись',
            'ip' => 'Ip',
            'url' => 'Url',
            'user_id' => 'User ID',
        ];
    }
}
