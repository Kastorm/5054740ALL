<?php

namespace andrew\import\components;

use andrew\import\models\SettingForm;
use andrew\import\models\TmpData;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Import
{
    public static function import()
    {
        $result = [];
        $settings = SettingForm::get(Yii::$app->session->get('import.supplier'));
        $extraOffset = 0;
        if ($settings->skipFirst)
        {
            $extraOffset += 1;
        }
        $supplierId = Yii::$app->session->get('import.supplier');
        $groupId = Yii::$app->session->get('import.group');
        $data = TmpData::find()
            ->where([
                'supplier_id' => $supplierId,
                'session_id' => Yii::$app->session->id,
                'deleted' => 0,
            ])
            ->offset($extraOffset);
        if ($groupId)
        {
            $data->andWhere(['group_id' => $groupId, ]);
        }
        $data = $data->all();
        $c = 0;
        $transaction = Yii::$app->db->beginTransaction();
        if ($settings->rewrite)
        {
            $priceModel = Yii::$app->controller->module->priceModel;
            $priceModel::deleteAll([
                'supplier_id' => $supplierId,
                //'group_id' => $groupId,
            ]);
        }
        /** @var ActiveRecord $groupModel */
        $groupModel = Yii::$app->controller->module->groupModel;
        $mappedFilds = array_values($settings->fields);
        $allGroups = ArrayHelper::getColumn($groupModel::find()
            ->select('id')
            ->asArray()
            ->all(), 'id');
        try
        {
            foreach ($data as $item)
            {
                $model = Yii::createObject(Yii::$app->controller->module->price['modelPath']);
                $model->supplier_id = $supplierId;
                $model->group_id = $groupId;
                foreach ($item->data as $k => $v)
                {
                    if (array_key_exists($k, $settings->fields) && !empty ($settings->fields[$k]))
                    {
                        $model->{$settings->fields[$k]
                        } = (string)$v;
                    }
                }
                if (in_array('group_id', $mappedFilds))
                {
                    if (!in_array($model->group_id, $allGroups))
                    {
                        $model->group_id = 0;
                    }
                }
                if ($model->save())
                {
                    $c++;

                }
                else
                {
                    throw new \Exception(sprintf("%s\n\nДанные:\n%s",
                    implode(PHP_EOL, AppHelper::getErrorsList($model->errors)), implode(PHP_EOL,
                    AppHelper::ArrayToList(ArrayHelper::filter($model->toArray(),
                    Yii::$app->controller->module->price['allowedFields'])))));
                }
            }
            $transaction->commit();
            $result['total'] = $c;
        }
        catch (\Exception $ex)
        {
            $transaction->rollBack();
            $result['error'] = $ex->getMessage();
        }

        return $result;
    }
}