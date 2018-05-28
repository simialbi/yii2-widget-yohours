<?php
/**
 * @package yii2-widget-yohours
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\yohours;


use simialbi\yii2\web\AssetBundle;

/**
 * Asset bundle for jSmart
 * @package simialbi\yii2\yohours
 */
class JsmartAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public $sourcePath = '@bower/jsmart/dist';
    /**
     * {@inheritdoc}
     */
    public $js = [
        'jsmart.min.js'
    ];
}