<?php


namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\modules\user\models\User;


/**
 * This is the model class for table "staff".
 *
 * @property integer $id
 * @property string $title
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $phone
 * @property string $description
 * @property integer $updated_at
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'name', 'address', 'phone'], 'required'],
            [['email'],'email'],
            [['updated_at', 'created_at', 'created_by', 'updated_by'], 'integer'],
            [['title', 'name', 'email', 'address', 'phone', 'description'], 'string', 'max' => 255]
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
            'title' => Yii::t('app', 'Title'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'address' => Yii::t('app', 'Address'),
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
