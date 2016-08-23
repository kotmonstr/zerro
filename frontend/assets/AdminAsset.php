<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'LTE/bootstrap/css/bootstrap.min.css',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        'LTE/dist/css/AdminLTE.min.css',
        'LTE/dist/css/skins/_all-skins.min.css',
        'LTE/style.css',
    ];
    public $js = [
        'LTE/plugins/jQuery/jQuery-2.1.4.min.js',
        'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
        'LTE/bootstrap/js/bootstrap.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
        'LTE/plugins/morris/morris.min.js',
        'LTE/plugins/sparkline/jquery.sparkline.min.js',
        'LTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'LTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        'LTE/plugins/knob/jquery.knob.js',
        'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js',
        'LTE/plugins/daterangepicker/daterangepicker.js',
        'LTE/plugins/datepicker/bootstrap-datepicker.js',
        'LTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        'LTE/plugins/slimScroll/jquery.slimscroll.min.js',
        'LTE/plugins/fastclick/fastclick.min.js',
        'LTE/dist/js/app.min.js',
        'LTE/dist/js/pages/dashboard.js',
        'LTE/dist/js/demo.js',


    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}

