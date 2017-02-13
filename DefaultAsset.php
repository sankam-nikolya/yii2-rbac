<?php

namespace sankam\rbac;

use yii\web\AssetBundle;

/**
 * AutocompleteAsset
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class DefaultAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@sankam/rbac/assets';
    /**
     * @inheritdoc
     */
    public $css = [
        YII_ENV_DEV ? 'jquery.treeview.css' : 'jquery.treeview.min.css',
        YII_ENV_DEV ? 'hierarchy.css' : 'hierarchy.min.css',
    ];
    /**
     * @inheritdoc
     */
    public $js = [
        YII_ENV_DEV ? 'jquery.treeview.js' : 'jquery.treeview.min.js',
    ];
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
