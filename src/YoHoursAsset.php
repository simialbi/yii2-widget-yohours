<?php
/**
 * @package yii2-widget-yohours
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\yohours;


use simialbi\yii2\web\AssetBundle;
use Yii;

/**
 * Asset bundle for yo hours Widget
 * @package simialbi\yii2\yohours
 */
class YoHoursAsset extends AssetBundle
{
    /**
     * {@inheritdoc}
     */
    public $sourcePath = '@bower/jquery-yohours/dist';
    /**
     * {@inheritdoc}
     */
    public $css = [
        'css/yohours.css'
    ];
    /**
     * {@inheritdoc}
     */
    public $js = [
        'js/jed.min.js',
        'js/yohours.min.js'
    ];
    /**
     * {@inheritdoc}
     */
    public $depends = [
        'yii\bootstrap4\BootstrapPluginAsset',
        'simialbi\yii2\yohours\FullcalendarAsset',
        'simialbi\yii2\yohours\JsmartAsset'
    ];
    /**
     * {@inheritdoc}
     */
    public $publishOptions = [
        'forceCopy' => YII_DEBUG
    ];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $lang = Yii::$app->language;
        if (file_exists(Yii::getAlias($this->sourcePath . '/js/i18n/' . $lang . '.min.js'))) {
            array_unshift($this->js, 'js/i18n/' . $lang . '.min.js');
        } elseif (false !== strpos('-', $lang)) {
            $tmp = explode('-', $lang);

            if (file_exists(Yii::getAlias($this->sourcePath . '/js/i18n/' . $tmp[0] . '.min.js'))) {
                array_unshift($this->js, 'js/i18n/' . $tmp[0] . '.min.js');
            }
        }

        parent::init();
    }
}