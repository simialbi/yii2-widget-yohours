<?php
/**
 * @package yii2-widget-yohours
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace yiiunit\extensions\yohours;


use simialbi\yii2\yohours\YoHours;
use simialbi\yii2\yohours\YoHoursAsset;
use Yii;
use yii\base\DynamicModel;
use yii\bootstrap5\ActiveField;
use yii\bootstrap5\ActiveForm;

class YoHourTest extends TestCase
{
    /**
     * @var ActiveField
     */
    private $_activeField;
    /**
     * @var DynamicModel
     */
    private $_helperModel;
    /**
     * @var ActiveForm
     */
    private $_helperForm;
    /**
     * @var string
     */
    private $_attributeName = 'attributeName';

    public function testHtml()
    {
        $html = $this->_activeField->widget(YoHours::class)->render();

        $expectedHtml = <<<HTML
<div class="mb-3 field-dynamicmodel-attributename">
<label class="form-label" for="dynamicmodel-attributename">Attribute Name</label>
<input type="text" id="dynamicmodel-attributename" class="form-control" name="DynamicModel[attributeName]">

<div class="invalid-feedback"></div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testAssets()
    {
        $this->_activeField->widget(YoHours::class);

        $assetBundle = new YoHoursAsset();
        $bundles = array_keys(Yii::$app->view->assetManager->bundles);

        $this->assertContains(YoHoursAsset::class, $bundles);
        foreach ($assetBundle->depends as $depend) {
            $this->assertContains($depend, $bundles);
        }
    }

    protected function setUp()
    {
        // dirty way to have Request object not throwing exception when running testHomeLinkNull()
        $_SERVER['SCRIPT_FILENAME'] = 'index.php';
        $_SERVER['SCRIPT_NAME'] = 'index.php';

        parent::setUp();

        $this->_helperModel = new DynamicModel(['attributeName']);
        ob_start();
        $this->_helperForm = ActiveForm::begin(['action' => '/something', 'enableClientScript' => false]);
        ActiveForm::end();
        ob_end_clean();

        $this->_activeField = new ActiveField(['form' => $this->_helperForm]);
        $this->_activeField->model = $this->_helperModel;
        $this->_activeField->attribute = $this->_attributeName;
    }
}
