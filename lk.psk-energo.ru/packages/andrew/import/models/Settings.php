<?php

namespace andrew\import\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%import_settings}}".
 *
 * @property int $supplier_id
 * @property string $settings
 */
class Settings extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%import_settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id'], 'integer'],
            [['settings'], 'string'],
            [['supplier_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'supplier_id' => 'supplier ID',
            'settings' => 'Settings',
        ];
    }
}
