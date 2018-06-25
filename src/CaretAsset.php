<?php
/**
 * @package yii2-widget-yohours
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\yohours;

use simialbi\yii2\web\AssetBundle;

/**
 * Asset bundle for jquery caret
 * @package simialbi\yii2\yohours
 */
class CaretAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public $sourcePath = '@npm/jquery-caret';
    /**
     * {@inheritdoc}
     */
    public $js = [
        'jquery.caret.js'
    ];
    /**
     * {@inheritdoc}
     */
    public $publishOptions = [
        'only' => [
            'jquery.caret.js'
        ],
        'forceCopy' => YII_DEBUG
    ];
}