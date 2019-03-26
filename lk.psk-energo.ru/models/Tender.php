<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use app\modules\user\models\User;

/**
 * This is the model class for table "tender".
 *
 * @property integer $id
 * @property integer $status
 * @property string $login
 * @property string $password
 * @property string $links
 * @property string $description
 * @property integer $updated_at
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Tender extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tender';
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
    public function rules()
    {
        return [
            [['title','login', 'password', 'links'], 'required'],
            [['links'],'linksValidation'],
            [['description'],'string'],
            [['title'],'unique','message'=>Yii::t('app','Field should be unique')],
            [['title','login', 'password', 'links'], 'string', 'max' => 255]
        ];
    }

    public function linksValidation()
    {
        foreach(explode(',',$this->links) as $link){
            if (!preg_match("/[^\.\/]+\.[^\.\/]+$/", $link)) {
                $this->addError('links',Yii::t('app','Field "Links" is incorrect. Correct is "www.example.ru,example.ru"'));
            }
        }
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title'=>Yii::t('app', 'Title'),
            'login' => Yii::t('app', 'Login'),
            'password' => Yii::t('app', 'Password'),
            'links' => Yii::t('app', 'Links'),
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
