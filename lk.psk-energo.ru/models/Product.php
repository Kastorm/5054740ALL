<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property integer $supplier_id
 * @property integer $group_id
 * @property string $name
 * @property string $size_l
 * @property string $size_b
 * @property string $size_h
 * @property string $mark_b
 * @property string $volume
 * @property string $weight
 * @property string $price_without_vat
 * @property string $price_with_vat
 *
 * @property SupplierGroup $group
 * @property Supplier $supplier
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'group_id'], 'integer'],
            [['price_without_vat', 'price_with_vat'], 'string', 'max' => 100],
            [['name', 'size_l', 'size_b', 'size_h', 'mark_b', 'volume', 'weight'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'supplier_id' => 'Поставщик',
            'group_id' => 'Группа',
            'name' => 'Название',
            'size_l' => 'Размер L',
            'size_b' => 'Размер B',
            'size_h' => 'Размер H',
            'mark_b' => 'Марка Б',
            'volume' => 'Объем, м3',
            'weight' => 'Вес, т',
            'price_without_vat' => 'Цена без НДС ',
            'price_with_vat' => 'Цена с НДС ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(SupplierGroup::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplier_id']);
    }
}
