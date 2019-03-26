<?php

namespace app\models;

use app\modules\user\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "supplier".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $title
 * @property string $inn
 * @property string $responsible
 * @property string $phone
 * @property string $address
 * @property string $comment
 * @property string $email
 * @property integer $updated_at
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'title', 'inn', 'responsible', 'phone', 'address', 'email'], 'required'],
            [['group_id', 'updated_at', 'created_at', 'created_by', 'updated_by'], 'integer'],
            ['title', 'string', 'max' => 100],
            ['inn', 'string', 'max' => 12],
            ['email', 'string', 'max' => 50],
            ['email', 'email'],
            ['phone', 'match', 'pattern' => '/^((\+7)(\d{10}))$/', 'message' => 'Неверный формат телефона. Необходимо +79999999999'],
            [['comment'], 'string'],
            [['title', 'inn', 'responsible', 'phone', 'address', 'email'], 'string', 'max' => 255]
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
            'group_id' => Yii::t('app', 'Group'),
            'title' => Yii::t('app', 'Supplier'),
            'inn' => Yii::t('app', 'Inn'),
            'responsible' => Yii::t('app', 'Responsible'),
            'phone' => Yii::t('app', 'Phone'),
            'address' => Yii::t('app', 'Address'),
            'comment' => Yii::t('app', 'Comment'),
            'email' => Yii::t('app', 'Email'),
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

    public function getGroup()
    {
        return $this->hasOne(SupplierGroup::className(), ['id' => 'group_id']);
    }

    public function getGroupName() {
        if(!empty($this->group)) {
            return $this->group->title;
        }
    }

    public function getGroups() {
        return ArrayHelper::map(SupplierGroup::find()->all(), 'id', 'title');
    }
}