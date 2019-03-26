<?php

namespace app\models;

use app\modules\user\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $title
 * @property string $inn
 * @property string $site
 * @property string $email
 * @property string $address
 * @property string $person
 * @property string $phone
 * @property string $description
 * @property integer $updated_at
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'inn', 'site', 'email', 'address', 'phone'], 'required'],
            ['title','string', 'max' => 100],
            ['inn','string', 'max' => 12],
            ['email','string', 'max' => 20],
            [['site', 'address', 'person', 'phone', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Customer'),
            'inn' => Yii::t('app', 'Inn'),
            'site' => Yii::t('app', 'Site'),
            'email' => Yii::t('app', 'Email'),
            'address' => Yii::t('app', 'Address'),
            'person' => Yii::t('app', 'Person'),
            'phone' => Yii::t('app', 'Phone'),
            'description' => Yii::t('app', 'Description'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
    public function getUpdatedByUser()
    {
        return $this->hasOne(User::className(),['id'=>'updated_by']);
    }
}
