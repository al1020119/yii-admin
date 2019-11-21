<?php

namespace backend\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * 后台应用程序资源包
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/static';
    public $css = [
        'css/bootstrap.min.css',
        'css/core.css',
        'css/components.css',
        'css/icons.css',
        'css/pages.css',
        'css/menu.css',
        'css/responsive.css',

        'css/www.css',
        'css/style.css',
        'css/animate.css',
        'font-awesome/css/font-awesome.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/jquery.min.js',
        'js/jquery.core.js',
        "js/common.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    //定义按需加载JS方法，注意加载顺序在最后
    public static function addScript($view, $file , $position = 3)
    {
        $view->registerJsFile((new self)->baseUrl.$file, [AppAsset::className(),'position' => $position, 'depends' => 'backend\assets\AppAsset']);
    }

    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $file)
    {
        $view->registerCssFile((new self)->baseUrl.$file, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }
}
