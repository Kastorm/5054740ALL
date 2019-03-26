<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26.09.15
 * Time: 19:40
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class MailingForm
 * @package app\models
 */
class MailingForm extends Model
{
    /**
     * @var
     */
    public $subject;
    public $body;

    /**
     * @var array
     */
    public $suppliers = [];

    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['suppliers', 'subject', 'body'], 'required'],
//            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'suppliers' => Yii::t('app', 'Suppliers'),
            'subject' => Yii::t('app', 'Subject'),
            'body' => Yii::t('app', 'Body'),
            'verifyCode' => Yii::t('app', 'Verification code'),
        ];
    }

    public function getSuppliersArray() {
        return ArrayHelper::map(Supplier::find()->all(), 'id', 'title');
    }

    /**
     * @return mixed
     */
    public function getFromEmail() {
        if(!Yii::$app->user->isGuest) {
            return Yii::$app->user->identity->email;
        }
    }

    /**
     * @return mixed
     */
    public function getFromName() {
        if(!Yii::$app->user->isGuest) {
            return Yii::$app->user->identity->username;
        }
    }

    /**
     * @return array
     */
    public function getFromAttributes() {
        if(Yii::$app->user->isGuest) {
            return [];
        }
        $identity = Yii::$app->user->identity;
        $fromAttributes = [];
        foreach($identity->attributes as $attribute => $value) {
            $fromAttributes['{' . $attribute . '_from}'] = $value;
        }
        return $fromAttributes;
    }

    /**
     * @param $attributes
     * @return array
     */
    protected function prepareAttributes($attributes) {
        $preparingAttributes = [];
        foreach($attributes as $attribute => $value) {
            $preparingAttributes['{' . $attribute . '}'] = $value;
        }
        return $preparingAttributes;
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmails()
    {
        $suppliers = Supplier::find()->andOnCondition(['id' => $this->suppliers])->all();
        $result = true;
        foreach($suppliers as $supplier) {
            $body = strtr($this->body, $this->prepareAttributes($supplier->attributes));
            $body = strtr($body, $this->fromAttributes);
            $currentResult = $this->send($supplier->email, $body);
            if($currentResult) {
                $mailingLog = new MailingLog();
                $mailingLog->user_from = $this->fromName;
                $mailingLog->email_from = $this->fromEmail;
                $mailingLog->email_to = $supplier->email;
                $mailingLog->body = $body;
                $mailingLog->save();
            }
            $result = $result && $currentResult;
        }
        return $result;
    }

    /**
     * @param $email
     * @param $body
     * @return bool
     */
    public function send($email, $body) {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->fromEmail => $this->fromName])
            ->setSubject($this->subject)
            ->setHtmlBody($body)
            ->send();
    }
}