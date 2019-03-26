<?php

namespace andrew\import\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%import_tmp}}".
 *
 * @property int $supplier_id
 * @property int $group_id
 * @property string $session_id
 * @property string $date
 * @property string $data
 */
class TmpData extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%import_tmp}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'data', 'session_id'], 'required'],
            [['group_id',], 'safe'],
            [['supplier_id', 'group_id'], 'integer'],
            [['session_id', 'data'], 'string'],
            [['date'], 'default', 'value' => (new \DateTime())->format('Y-m-d')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'supplier_id' => 'supplier ID',
            'group_id' => 'Group ID',
            'data' => 'Data',
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->data = json_decode($this->data, true);
        parent::afterFind();
    }
}
