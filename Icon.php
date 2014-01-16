<?php
namespace artkost\uikit;

use yii\helpers\Html;
use yii\base\InvalidConfigException;

/**
 * Icon renders a UIkit icon
 *
 * For example,
 *
 * ```php
 * echo Icon::widget(['name' => 'fast-backward']);
 * ]);
 * ```
 * @see http://www.getuikit.com/docs/icon.html
 * @author Nikolay Kostyurin <nikolay@artkost.ru>
 * @since 2.0
 */
class Icon extends Widget
{

    /**
     * @var string the icon name
     */
    public $name = '';

    /**
     * Renders the widget.
     */
    public function run()
    {
        if (!$this->name) {
            throw new InvalidConfigException("The 'name' option is required.");
        }

        echo Html::tag('i', '', ['class' => 'uk-icon-' . $this->name]);
    }
}
