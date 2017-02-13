<?php

namespace sankam\rbac;

use yii\web\AssetBundle;

/**
 * Description of ModuleAsset 
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 2.5
 */
class ModuleAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@sankam/rbac/assets';
    /**
     * @inheritdoc
     */
    public $css = [
        YII_ENV_DEV ? 'animate.css' : 'animate.min.css'
    ];

}
