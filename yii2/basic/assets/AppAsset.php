<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bootstrap.css',
        'css/font-awesome.css',
        'css/lightbox.css',
//        'css/style1.css',
    ];
    public $js = [
        'js/bootstrap.js',
        'js/jquery.countup.js',
        'js/jquery.flexisel.js',
        'js/jquery.waypoints.min.js',
//        'js/jquery-2.1.4.min.js',
//        'js/lightbox-plus-jquery.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
