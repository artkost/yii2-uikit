<?php
namespace yii\uikit;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * ButtonGroup renders a button group component.
 *
 * For example,
 *
 * ```php
 * // a button group with items configuration
 * echo ButtonGroup::widget([
 *     'buttons' => [
 *         ['label' => 'A'],
 *         ['label' => 'B'],
 *     ]
 * ]);
 *
 * // button group with an item as a string
 * echo ButtonGroup::widget([
 *     'buttons' => [
 *         Button::widget(['label' => 'A']),
 *         ['label' => 'B'],
 *     ]
 * ]);
 * ```
 * @see http://www.getuikit.com/docs/button.html
 * @author Nikolay Kostyurin <nikolay@artkost.ru>
 * @since 2.0
 */
class ButtonGroup extends Widget
{
	/**
	 * @var array list of buttons. Each array element represents a single button
	 * which can be specified as a string or an array of the following structure:
	 *
	 * - label: string, required, the button label.
	 * - options: array, optional, the HTML attributes of the button.
	 */
	public $buttons = [];
	/**
	 * @var boolean whether to HTML-encode the button labels.
	 */
	public $encodeLabels = true;


	/**
	 * Initializes the widget.
	 * If you override this method, make sure you call the parent implementation first.
	 */
	public function init()
	{
		parent::init();
		Html::addCssClass($this->options, 'uk-button-group');
	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo Html::tag('div', $this->renderButtons(), $this->options);
        UIkitAsset::register($this->getView());
	}

	/**
	 * Generates the buttons that compound the group as specified on [[items]].
	 * @return string the rendering result.
	 */
	protected function renderButtons()
	{
		$buttons = [];
		foreach ($this->buttons as $button) {
			if (is_array($button)) {
				$label = ArrayHelper::getValue($button, 'label');
				$options = ArrayHelper::getValue($button, 'options');
				$buttons[] = Button::widget([
					'label' => $label,
					'options' => $options,
					'encodeLabel' => $this->encodeLabels
				]);
			} else {
				$buttons[] = $button;
			}
		}
		return implode("\n", $buttons);
	}
}
