<?php
/**
 * Created by PhpStorm.
 * User: serega
 * Date: 11.07.17
 * Time: 9:04
 */

namespace app\xfilter\widget;


use yii\web\AssetBundle;

class XFWidgetAsset extends AssetBundle
{
    public $sourcePath = '@app/xfilter/widget/views';

    public $css = [
        'css/xf_style.css',
    ];

    public $js = [
        'js/jquery.validate.min.js',
        'js/xf_validation.js',
    ];

    public $depends = [
        '\yii\web\JqueryAsset',
    ];
}