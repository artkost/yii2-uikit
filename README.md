UIkit Extension for Yii 2
=====================================

This is the UIkit extension for Yii 2. Clone of Yii 2 Bootstrap extension. It encapsulates UIkit components
and plugins in terms of Yii widgets, and thus makes using UIkit components/addons
in Yii applications extremely easy. For example, the following
single line of code in a view file would render a Progress plugin:

```php
<?= artkost\uikit\Progress::widget(['percent' => 60, 'label' => 'test']) ?>
```


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require artkost/yii2-uikit "*"
```

or add

```
"artkost/yii2-uikit": "*"
```

to the require section of your `composer.json` file.

