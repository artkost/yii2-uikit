<?php
namespace artkost\uikit;

use yii\web\AssetBundle;

/**
 * Almost flat theme for UIkit
 *
 * @author Nikolay Kostyurin <nikolay@artkost.ru>
 * @since 2.0
 */
class UIkitAlmostFlatAsset extends AssetBundle
{
    public $sourcePath = '@vendor/uikit/uikit/dist';
    public $css = [
        'css/uikit.almost-flat.css',
    ];
    public $depends = [
        'artkost\uikit\UIkitAsset',
    ];
}