<?php
namespace andrew\import\models;

use andrew\import\components\AppHelper;
use andrew\import\components\Excel;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use Yii;

class UploadForm extends Model
{
    public $file;
    public $supplier;
    public $group;

    public function rules()
    {
        return [
            [
                ['file'],
                'file',
                'skipOnEmpty' => false,
                'checkExtensionByMimeType' => false,
                'extensions' => 'xls,xlsx',
            ],
            [['supplier',], 'required'],
            [['group',], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => 'Файл',
            'supplier' => 'Поставщик',
            'group' => 'Группа',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $fileName = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $this->file->baseName . '.' . $this->file->extension;
            $this->file->saveAs($fileName);
            if (count($data = Excel::import($fileName, [
                    'setFirstRecordAsKeys' => false,
                ])) > 0
                && count($data[0])
            ) {
                TmpData::deleteAll(['supplier_id' => $this->supplier]);
                $c = 0;
                foreach ($data[0] as $row) {
                    $row = array_slice($row, 0, Yii::$app->controller->module->limitColumnsTo);
                    if (!mb_strlen(implode('', array_values($row)), 'UTF-8')) {
                        continue;
                    }
                    $tmpData = new TmpData();
                    $tmpData->supplier_id = $this->supplier;
                    $tmpData->group_id = $this->group;
                    $tmpData->session_id = Yii::$app->session->id;
                    $tmpData->data = json_encode($row);
                    if (!$tmpData->save()) {
                        throw new \Exception(implode(PHP_EOL, AppHelper::getErrorsList($tmpData->errors)));
                    }
                }
            } else {
                $this->addError('file', 'Файл пустой');
            }
        }

        return count($this->errors) > 0
            ? false
            : true;
    }

    public function getSupplierList()
    {
        $supplier = Yii::$app->controller->module->getSupplierModel();

        return ArrayHelper::map($supplier::find()
            ->all(), Yii::$app->controller->module->supplier['id'], Yii::$app->controller->module->supplier['name']);
    }

    public function getGroupList()
    {
        $group = Yii::$app->controller->module->getGroupModel();

        return ArrayHelper::map($group::find()
            ->all(), Yii::$app->controller->module->group['id'], Yii::$app->controller->module->group['name']);
    }
}
