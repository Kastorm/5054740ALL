<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 14.06.15
 * Time: 19:55
 * To change this template use File | Settings | File Templates.
 */
namespace app\widgets;

use Yii;
use yii\bootstrap\Nav;

class MainMenu extends Nav {
    public function init() {
        $this->initItems();
        return parent::init();
    }

    protected function initItems() {
        if(!Yii::$app->user->isGuest) {
            $this->items[] = ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']];
        }

        foreach([
                    '/tender/index' => Yii::t('app', 'Tenders'),
                    '/customer/index' => Yii::t('app', 'Customers'),
                    '/staff/index' => Yii::t('app', 'Staff'),
                    '/user/admin/index' => Yii::t('app', 'Users'),
                    '/supplier/index' => Yii::t('app', 'Suppliers'),

                ] as $url => $label) {
            if(Yii::$app->user->can($url)) {
                $this->items[] = ['label' => $label, 'url' => $url];
            }
        }

        $this->items[] = Yii::$app->user->isGuest ?
            ['label' => Yii::t('app', 'Login'), 'url' => Yii::$app->user->loginUrl] :
            ['label' => Yii::t('app', 'Logout') . ' (' . Yii::$app->user->identity->username . ')',
                'url' => ['/user/security/logout'],
                'linkOptions' => ['data-method' => 'post']];
    }
}