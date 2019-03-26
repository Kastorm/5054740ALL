<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 14.06.15
 * Time: 13:47
 * To change this template use File | Settings | File Templates.
 */

namespace app\modules\user\components;

use Yii;
use yii\base\Behavior;
use yii\web\Controller;
use yii\web\HttpException;

/**
 * Class RbacFilter
 * @package app\modules\user\components
 */
class RbacFilter extends Behavior {
    /**
     * @var array
     */
    public $allow = [];

    /**
     * Declares event handlers for the [[owner]]'s events.
     * @return array events (array keys) and the corresponding event handler methods (array values).
     */
    public function events() {
        return [Controller::EVENT_BEFORE_ACTION => 'beforeAction'];
    }

    /**
     * @param ActionEvent $event
     * @return boolean
     * @throws HttpException
     */
    public function beforeAction($event) {
        $rule = [];

        if(Yii::$app->controller->module->id != 'basic') {
            $rule[] = Yii::$app->controller->module->id;
        }
        $rule[] = Yii::$app->controller->id;
        $rule[] = Yii::$app->controller->action->id;
        $ruleRoute = implode('-', $rule);

        if(in_array($ruleRoute, $this->allow)) {
            return $event->isValid;
        }

        if(!Yii::$app->user->can($ruleRoute)) {
            throw new HttpException(403, 'Access deny ' . $ruleRoute);
        }

        return $event->isValid;
    }
}