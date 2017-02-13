<?php

namespace sankam\rbac;

use yii\web\AssetBundle;

/**
 * AutocompleteAsset
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class AutocompleteAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@sankam/rbac/assets';
    /**
     * @inheritdoc
     */
    public $css = [
        YII_ENV_DEV ? 'jquery-ui.css' : 'jquery-ui.min.css',
    ];
    /**
     * @inheritdoc
     */
    public $js = [
        YII_ENV_DEV ? 'jquery-ui.js' : 'jquery-ui.min.js',
    ];
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
