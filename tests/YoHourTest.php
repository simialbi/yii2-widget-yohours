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
use yii\bootstrap4\ActiveField;
use yii\bootstrap4\ActiveForm;

class YoHourTest extends TestCase
{
    /**
     * @var ActiveField
     */
    private $activeField;
    /**
     * @var DynamicModel
     */
    private $helperModel;
    /**
     * @var ActiveForm
     */
    private $helperForm;
    /**
     * @var string
     */
    private $attributeName = 'attributeName';

    public function testHtml()
    {
        $html = $this->activeField->widget(YoHours::class)->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<label class="control-label" for="dynamicmodel-attributename">Attribute Name</label>
<input type="text" id="dynamicmodel-attributename" name="DynamicModel[attributeName]">

<p class="text-danger"></p>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testAssets()
    {
        $this->activeField->widget(YoHours::class);

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
        $_SERVER['SCRIPT_FILENAME'] = "index.php";
        $_SERVER['SCRIPT_NAME'] = "index.php";

        parent::setUp();

        $this->helperModel = new DynamicModel(['attributeName']);
        ob_start();
        $this->helperForm = ActiveForm::begin(['action' => '/something', 'enableClientScript' => false]);
        ActiveForm::end();
        ob_end_clean();

        $this->activeField = new ActiveField(['form' => $this->helperForm]);
        $this->activeField->model = $this->helperModel;
        $this->activeField->attribute = $this->attributeName;
    }
}