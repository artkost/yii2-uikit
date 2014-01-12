<?php
namespace yii\uikit;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Dropdown renders a UIkit dropdown menu component.
 *
 * ```php
 * use yii\uikit\Dropdown;
 * use yii\uikit\Nav;
 *
 * Dropdown::begin([
 *  'tagOptions' => ['class' => 'uk-button-dropdown'],
 *  'toggleButton' => ['label' => 'Action'],
 *  'items' => []
 * ]);
*   echo Nav::widget([
 *     'options' => ['class' => 'uk-nav-dropdown'],
 *     'items' => [
 *         [
 *             'label' => 'Home',
 *             'url' => ['site/index'],
 *             'linkOptions' => [...],
 *         ],
 *         [
 *             'label' => 'Dropdown',
 *             'items' => [
 *                  ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
 *                  '<li class="divider"></li>',
 *                  '<li class="dropdown-header">Dropdown Header</li>',
 *                  ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
 *             ],
 *         ],
 *     ],
 * ]);
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

    public $itemsOptions = [];

    public $toggleButton = [];

    /**
     * Container tag name, by default it can be div
     * @var string
     */
    public $tag = 'div';

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

        if ($this->tag) {
            echo Html::beginTag($this->tag, $this->tagOptions) . "\n";
        }
        echo $this->renderToggleButton() . "\n";
        echo Html::beginTag('div', $this->options);
	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo $this->renderItems($this->items);
        echo Html::endTag('div');

        if ($this->tag) {
            echo Html::endTag($this->tag);
        }

        $this->registerAsset();
	}

    /**
     * Renders the toggle button.
     * @return string the rendering result
     */
    protected function renderToggleButton()
    {
        if ($this->toggleButton !== null) {
            $tag = ArrayHelper::remove($this->toggleButton, 'tag', 'a');
            $label = ArrayHelper::remove($this->toggleButton, 'label', 'Show');

            if ($tag === 'button' && !isset($this->toggleButton['type'])) {
                $this->toggleButton['type'] = 'button';
            }

            if ($tag === 'a' && !isset($this->toggleButton['href'])) {
                $this->toggleButton['href'] = '#' . $this->options['id'];
            }

            return Html::tag($tag, $label, $this->toggleButton);
        } else {
            return null;
        }
    }

	/**
	 * Renders menu items.
	 * @param array $items the menu items to be rendered
	 * @return string the rendering result.
	 * @throws InvalidConfigException if the label option is not specified in one of the items.
	 */
	protected function renderItems($items)
	{
        if ($this->tag) {
            Html::addCssClass($this->itemsOptions, 'uk-nav-dropdown');
        }

        if (is_array($items)) {
            return Nav::widget(['options' => $this->itemsOptions, 'items' => $items]);
        }

        return $items;
	}
}
