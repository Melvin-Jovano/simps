<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/styles.css',
        'css/dataTables.css',
        'css/main.css',
        'fa/css/all.min.css',
        'css/daterangepicker.css',
    ];
    public $js = [
        'js/bootstrap.bundle.min.js',
        'js/scripts.js',
        'js/chart.min.js',
        'js/jquery.dataTables.min.js',
        'js/dataTables.bs4.min.js',
        'js/demo/datatables-demo.js',
        'js/moment.min.js',
        'js/daterangepicker.js',
        'html2pdf/ppdf.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
