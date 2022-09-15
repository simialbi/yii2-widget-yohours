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
use yii\helpers\Json;

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
     * @var array Template overrides
     *
     * E.g. to use font awesome icons:
     * ```php
     * [
     *     'iconClock' => '<i class="fas fa-clock"></i>',
     *     'iconPencil' => '<i class="fas fa-pencil-alt"></i>',
     *     'iconTrash' => '<i class="fas fa-trash-alt"></i>'
     * ]
     * ```
     * @see [[https://github.com/simialbi/jquery-yohours]]
     */
    public array $templates = [];

    /**
     * {@inheritDoc}
     */
    public function init(): void
    {
        parent::init();

        Html::addCssClass($this->options, 'form-control');

        if (!isset($this->clientOptions['locale'])) {
            $this->clientOptions['locale'] = ArrayHelper::getValue(explode('-', Yii::$app->language), '0', 'en');
        }
        if (!isset($this->clientOptions['bootstrapVersion'])) {
            if (class_exists('\yii\bootstrap5\Html')) {
                $this->clientOptions['bootstrapVersion'] = 'bootstrap5';
            } elseif (class_exists('\yii\bootstrap4\Html')) {
                $this->clientOptions['bootstrapVersion'] = 'bootstrap4';
            } else {
                $this->clientOptions['bootstrapVersion'] = 'bootstrap3';
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function run(): string
    {
        parent::run();

        $html = $this->renderInputHtml('text');
        $this->registerPlugin('yoHours');

        return $html;
    }

    /**
     * {@inheritDoc}
     */
    protected function registerPlugin(?string $pluginName = null, ?string $selector = null)
    {
        $view = $this->view;
        YoHoursAsset::register($view);

        $id = $this->options['id'];

        if (empty($selector)) {
            $selector = '#' . $id;
        }

        if ($this->clientOptions !== false) {
            $options = Json::htmlEncode($this->clientOptions);
            $templates = Json::htmlEncode($this->templates);
            $js = "jQuery('$selector').$pluginName($options, $templates);";
            $view->registerJs($js);
        }

        $this->registerClientEvents();
    }
}
