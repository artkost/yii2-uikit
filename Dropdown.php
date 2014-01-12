<?php
namespace yii\uikit;

use yii\base\InvalidConfigException;
use yii\helpers\Html;

/**
 * Dropdown renders a UIkit dropdown menu component.
 *
 * ```php
 * use yii\uikit\Dropdown;
 * use yii\widgets\Menu;
 *
 * Dropdown::begin(['tagOptions' => ['class' => 'uk-button-dropdown']]);
 * echo Button::widget(['label' => 'Action']);
 * Dropdown::end();
 * ```
 *
 * @see http://www.getuikit.com/docs/dropdown.html
 * @author Nikolay Kostyurin <nikolay@artkost.ru>
 * @since 2.0
 */
class Dropdown extends Widget
{
	/**
	 * @var array list of menu items in the dropdown. Each array element can be either an HTML string,
	 * or an array representing a single menu with the following structure:
	 *
	 * - label: string, required, the label of the item link
	 * - url: string, optional, the url of the item link. Defaults to "#".
	 * - visible: boolean, optional, whether this menu item is visible. Defaults to true.
	 * - linkOptions: array, optional, the HTML attributes of the item link.
	 * - options: array, optional, the HTML attributes of the item.
	 *
	 * To insert divider use `<li role="presentation" class="divider"></li>`.
	 */
	public $items = [];

    /**
     * Container tag name, by default it can be div
     * @var string
     */
    public $tagName = '';

    public $tagOptions = [];

	/**
	 * Initializes the widget.
	 * If you override this method, make sure you call the parent implementation first.
	 */
	public function init()
	{
		parent::init();
		Html::addCssClass($this->options, 'uk-dropdown');

        $this->tagOptions['data-uk-dropdown'] = $this->jsonClientOptions();

        if ($this->tagName) {
            echo Html::beginTag($this->tagName, $this->tagOptions);
        }

	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
        echo Html::beginTag('div', $this->options);
		echo $this->renderItems($this->items);
        echo Html::endTag('div');

        if ($this->tagName) {
            echo Html::endTag($this->tagName);
        }

        $this->registerAsset();
	}

	/**
	 * Renders menu items.
	 * @param array $items the menu items to be rendered
	 * @return string the rendering result.
	 * @throws InvalidConfigException if the label option is not specified in one of the items.
	 */
	protected function renderItems($items)
	{
        if (is_array($items)) {
            return Nav::widget(['options' => ['class' => 'uk-nav-dropdown'], 'items' => $items]);
        }

        return $items;
	}
}
