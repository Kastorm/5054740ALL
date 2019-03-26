<?php
namespace andrew\import\models;

use andrew\import\components\AppHelper;
use yii\base\Model;
use Yii;

class SettingForm extends Model
{
    public $skipFirst;
    public $rewrite;
    public $fields = [];
    public $next = 0;

    public function rules()
    {
        return [
            [['fields', 'skipFirst', 'rewrite', 'next'], 'safe'],
            [['fields'], 'fieldsValidator'],
        ];
    }

    public function fieldsValidator($attribute)
    {
        $requiredFields = Yii::$app->controller->module->price['requiredFields'];
        if (count($intersectFields = array_diff($requiredFields, $this->fields)) == 0) {

        } else {
            $this->addError($attribute, sprintf('Следующие поля обязательны: %s', implode(', ', $intersectFields)));
        }
    }

    public function attributeLabels()
    {
        return [
            'skipFirst' => 'Пропустить первую строку',
            'rewrite' => 'Перезаписать',
        ];
    }

    public function getFieldsList()
    {
        $result = [];
        $price = Yii::$app->controller->module->getPriceModel();
        $attributeLabels = $price->attributeLabels();
        foreach (Yii::$app->controller->module->price['allowedFields'] as $allowedField) {
            $label = $allowedField;
            if (array_key_exists($allowedField, $attributeLabels)) {
                $label = $attributeLabels[$allowedField];
            }
            $result[$allowedField] = $label;
        }

        return $result;
    }

    public static function get($supplierId)
    {
        $model = new self();
        if ($settingsModel = Settings::findOne(['supplier_id' => $supplierId])) {
            $settings = json_decode($settingsModel->settings, true);
            $model->setAttributes($settings);
        } else {
            $c = 0;
            foreach (Yii::$app->controller->module->price['allowedFields'] as $allowedField) {
                $position = $c++;
                if ($oldPosition = array_search($allowedField, $model->fields)) {
                    $position = $oldPosition;
                }
                if (!array_search($position, $model->fields)) {
                    $model->fields[$position] = $allowedField;
                }
            }
        }

        return $model;
    }

    public function set($supplier_id)
    {
        if ($this->validate()) {
            if (!($model = Settings::findOne(['supplier_id' => $supplier_id]))) {
                $model = new Settings();
                $model->supplier_id = $supplier_id;
            }
            $next = $this->next;
            $this->next = null;
            $model->settings = json_encode($this);
            $model->save();
            $this->next = $next;
        } else {
            $errors = $this->errors;
            $this->clearErrors();
            throw new \Exception(implode(PHP_EOL, AppHelper::getErrorsList($errors)));
        }

        return true;
    }
}
