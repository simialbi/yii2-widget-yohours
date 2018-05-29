<?php
/**
 * @package yii2-widget-yohours
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\yohours;

use simialbi\yii2\widgets\InputWidget;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * The YoHours widget renders a bootstrap styled calendar input widget for
 * to create [opening_hours](https://wiki.openstreetmap.org/wiki/Key:opening_hours) data
 *
 * For example to use the widget with a [[\yii\base\Model|model]]:
 *
 * ```php
 * <?php
 *    echo YoHours::widget([
 *        'model' => $model,
 *        'attribute' => 'opening_hours',
 *        // 'clientOptions' => [
 *            // 'locale' => 'en',
 *            // 'bootstrapVersion' => 'bootstrap4',
 *            // 'height' => 600,
 *            // 'delay' => 700
 *        // ]
 *    ]);
 * ?>
 * ```
 *
 * The following example will use the name property instead:
 *
 * ```php
 * <?php
 *    echo YoHours::widget([
 *        'name'  => 'opening_hours',
 *        'value'  => $value,
 *        // 'clientOptions' => [
 *            // 'locale' => 'en',
 *            // 'bootstrapVersion' => 'bootstrap4',
 *            // 'height' => 600,
 *            // 'delay' => 700
 *        // ]
 *    ]);
 * ?>
 * ```
 *
 * You can also use this widget in an [[\yii\widgets\ActiveForm|ActiveForm]] using the
 * [[\yii\widgets\ActiveField::widget()|widget()]] method, for example like this:
 *
 * ```php
 * <?= $form->field($model, 'opening_hours')->widget(\simialbi\yii2\yohours\YoHours::class, [
 *        // 'clientOptions' => [
 *            // 'locale' => 'en',
 *            // 'bootstrapVersion' => 'bootstrap4',
 *            // 'height' => 600,
 *            // 'delay' => 700
 *        // ]
 * ]); ?>
 * ```
 *
 * @see https://wiki.openstreetmap.org/wiki/Key:opening_hours
 * @see https://github.com/simialbi/jquery-yohours
 * @see http://projets.pavie.info/yohours/
 * @package simialbi\yii2\yohours
 */
class YoHours extends InputWidget
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Html::addCssClass($this->options, 'form-control');

        if (!isset($this->clientOptions['locale'])) {
            $this->clientOptions['locale'] = ArrayHelper::getValue(explode('-', Yii::$app->language), '0', 'en');
        }
        if (!isset($this->clientOptions['bootstrapVersion'])) {
            if (class_exists('\yii\bootstrap4\Html')) {
                $this->clientOptions['bootstrapVersion'] = 'bootstrap4';
            } else {
                $this->clientOptions['bootstrapVersion'] = 'bootstrap3';
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        parent::run();

        $html = $this->renderInputHtml('text');
        $this->registerPlugin('yoHours');

        return $html;
    }
}