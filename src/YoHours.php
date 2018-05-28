<?php
/**
 * @package yii2-widget-yohours
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\yohours;

use simialbi\yii2\widgets\InputWidget;

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
 *        'attribute' => 'opening_hours'
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
 *        'value'  => $value
 *    ]);
 * ?>
 * ```
 *
 * You can also use this widget in an [[\yii\widgets\ActiveForm|ActiveForm]] using the
 * [[\yii\widgets\ActiveField::widget()|widget()]] method, for example like this:
 *
 * ```php
 * <?= $form->field($model, 'opening_hours')->widget(\simialbi\yii2\yohours\YoHours::class, [
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