<?php

namespace app\models;

use app\modules\user\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "mailing_log".
 *
 * @property integer $id
 * @property string $user_from
 * @property string $email_from
 * @property string $email_to
 * @property string $body
 * @property integer $updated_at
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class MailingLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mailing_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_from', 'email_from', 'email_to', 'body'], 'required'],
            [['body'], 'string'],
            [['updated_at', 'created_at', 'created_by', 'updated_by'], 'integer'],
            [['user_from', 'email_from', 'email_to'], 'string', 'max' => 255]
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
            'id' => 'ID',
            'user_from' => Yii::t('app', 'User From'),
            'email_from' => Yii::t('app', 'Email From'),
            'email_to' => Yii::t('app', 'Email To'),
            'body' => Yii::t('app', 'Body'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function getUpdatedByUser()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getCreatedByUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}