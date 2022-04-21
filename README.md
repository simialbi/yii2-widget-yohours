# yii2-widget-yohours

This extension integrates an [OSM compatible Opening Hours widget](https://wiki.openstreetmap.org/wiki/Key:opening_hours)
into yii2 framework. It's based on [Adrien Pavie](https://github.com/PanierAvide)'s 
[YoHours Application](http://projets.pavie.info/yohours/).

A live demo is available at [projets.pavie.info/yohours](http://projets.pavie.info/yohours/).

## Resources
 * [jQuery yohours plugin](https://github.com/simialbi/jquery-yohours)
 * [yii2](https://github.com/yiisoft/yii2) framework
 * [bootstrap 3 | 4 | 5](https://getbootstrap.com)

## Installation 

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require --prefer-dist simialbi/yii2-widget-yohours
```

or add 

```
"simialbi/yii2-widget-yohours": "*"
```

to the ```require``` section of your `composer.json`

## Example Usage

To include an yohours input field widget call the widget like this:

````php
<?php
/* @var $this yii\web\View */
/* @var $value string */

use simialbi\yii2\yohours\YoHours;
    
?>


<div class="my-form">
    <?php

    echo YoHours::widget([
        'name'  => 'opening_hours',
        'value'  => $value,
        // 'clientOptions' => [
           // 'locale' => 'en',
           // 'bootstrapVersion' => 'bootstrap4',
           // 'height' => 600,
           // 'delay' => 700
        // ]
    ]);
    
    // or model like usage
    /* @var $form \yii\widgets\ActiveForm */
    /* @var $model \yii\base\Model */
    echo $form->field($model, 'opening_hours')->widget(YoHours::class, [
        // 'clientOptions' => [
           // 'locale' => 'en',
           // 'bootstrapVersion' => 'bootstrap4',
           // 'height' => 600,
           // 'delay' => 700
        // ]
    ]);
?>
</div>

````

## License

**yii2-widget-yohours** is released under MIT license. See bundled [LICENSE](LICENSE) for details.
