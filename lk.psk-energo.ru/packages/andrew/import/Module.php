<?php

namespace andrew\import;

use Yii;
use yii\base\InvalidConfigException;

class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'andrew\import\controllers';

    public $supplier;
    public $group;
    public $price;
    public $limitColumnsTo = 10;

    protected $supplierModel;
    protected $groupModel;
    protected $priceModel;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        try {
            $this->supplierModel = Yii::createObject($this->supplier['modelPath']);
        } catch (InvalidConfigException $exception) {
            throw new \Exception('Invalid Supplier config');
        }
        try {
            $this->groupModel = Yii::createObject($this->group['modelPath']);
        } catch (InvalidConfigException $exception) {
            throw new \Exception('Invalid Group config');
        }
        try {
            $this->priceModel = Yii::createObject($this->price['modelPath']);
        } catch (InvalidConfigException $exception) {
            throw new \Exception('Invalid Price config');
        }
    }

    public function getSupplierModel()
    {
        return $this->supplierModel;
    }

    public function getGroupModel()
    {
        return $this->groupModel;
    }

    public function getPriceModel()
    {
        return $this->priceModel;
    }
}
