<?php

namespace common\assets;

use yii\web\AssetBundle;

class CurrencyConverterAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
    ];

    public $js = [
        'js/currency-converter.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
