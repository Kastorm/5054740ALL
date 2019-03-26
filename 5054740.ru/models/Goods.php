<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property int $goodID
 * @property int $groupID
 * @property string $name
 * @property string $url
 * @property string $content
 * @property string $image
 * @property string $image_small
 * @property string $image_big
 * @property int $noImage
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['groupID', 'name', 'url', 'content', 'image', 'image_small', 'image_big'], 'required'],
            [['groupID', 'noImage'], 'integer'],
            [['content'], 'string'],
            [['name', 'url', 'image', 'image_small', 'image_big'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'goodID' => 'Good ID',
            'groupID' => 'Group ID',
            'name' => 'Name',
            'url' => 'Url',
            'content' => 'Content',
            'image' => 'Image',
            'image_small' => 'Image Small',
            'image_big' => 'Image Big',
            'noImage' => 'No Image',
        ];
    }
}
