<?php

namespace common\models;

use Symfony\Component\Yaml\Tests\InlineTest;
use Yii;


/**
 * This is the model class for table "zavod".
 *
 * @property int $id
 * @property int $group_id
 * @property string $name
 * @property int $inn
 * @property string $tel
 * @property string $email
 * @property string $url
 * @property int $id_city
 * @property string $status
 * @property string $adres
 * @property string $coment
 */
class Zavod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zavod';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'inn', 'id_city'], 'integer'],
            [['name', 'email','url', 'adres', 'coment'], 'required'],
            [['status', 'coment'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['tel'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 40],
            [['url'], 'string', 'max' => 50],
            [['adres'], 'string', 'max' => 250],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Группа',
            'name' => 'Наименования',
            'inn' => 'ИНН',
            'tel' => 'Телефон',
            'email' => 'Email',
            'url' => 'Сайт',
            'id_city' => 'Город',
            'status' => 'Статус',
            'adres' => 'Адрес',
            'coment' => 'Коментарий',
            'StatusName' => 'Статус',
            'gorod.name' => 'Город',
            'groups.group'=> 'Группа',

        ];
    }



    /**
     * Выводим статус завода действует или не действует
     */

    public static function getStatusList()
    {
        return ['Закрыт','Работает'];
    }

    public function getStatusName()
    {
        $list=self::getStatusList();
        return $list [$this->status];

    }

    /**
     * Выводим город из таблицы Cyti
     */
    public function getGorod()
    {
        return $this->hasOne(City::className(),['id'=>'id_city']);

    }
    /**
     * Выводим группы из таблицы Group
     */
    public function getGroups()
    {
        return $this->hasOne(Group::className(),['id'=>'group_id']);

    }

}
