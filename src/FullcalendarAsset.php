<?php
/**
 * @package yii2-widget-yohours
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\yohours;


use simialbi\yii2\web\AssetBundle;

/**
 * Asset bundle for FullCalendar
 * @package simialbi\yii2\yohours
 */
class FullcalendarAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public $sourcePath = '@bower/fullcalendar/dist';
    /**
     * {@inheritdoc}
     */
    public $js = [
        'fullcalendar.min.js'
    ];
    /**
     * {@inheritdoc}
     */
    public $css = [
        'fullcalendar.min.css'
    ];
    /**
     * {@inheritdoc}
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'simialbi\yii2\web\MomentAsset'
    ];
}