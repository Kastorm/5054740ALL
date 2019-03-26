<?php
/**
 * @copyright Copyright (c) 2014 Roman Ovchinnikov
 * @link https://github.com/RomeroMsk
 * @version 1.0.1
 */
namespace app\widgets\chosen;

use yii\web\AssetBundle;

/**
 * Class ChosenAsset
 * @package app\widgets\chosen
 */
class ChosenAsset extends AssetBundle {
    public $sourcePath = '@app/widgets/chosen/assets';

    public $css = [
        'css/chosen.bootstrap.css'
    ];

    public $js = [
        'js/chosen.jquery.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}