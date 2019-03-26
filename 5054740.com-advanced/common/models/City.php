<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $Name
 * @property string $region
 * @property string $okrug
 * @property int $ludi
 * @property string $god
 * @property int $id_zavod
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ludi', 'id_zavod'], 'integer'],
            [['name', 'region', 'okrug', 'god'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'region' => 'Region',
            'okrug' => 'Okrug',
            'ludi' => 'Ludi',
            'god' => 'God',
            'id_zavod' => 'Id Zavod',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CityQuery(get_called_class());
    }
}
