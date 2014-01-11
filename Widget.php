<?php
namespace yii\uikit;

use Yii;
use yii\helpers\Json;

/**
 * \yii\uikit\Widget is the base class for all UIkit widgets.
 *
 * @author Nikolay Kostyurin <nikolay@artkost.ru>
 * @since 2.0
 */
class Widget extends \yii\base\Widget
{
	/**
	 * @var array the HTML attributes for the widget container tag.
	 */
	public $options = [];
	/**
	 * @var array the options for the underlying JS plugin.
	 * Please refer to the corresponding plugin Web page for possible options.
	 * For example, [this page](http://www.getuikit.com/docs/components.html) shows
	 * how to use the "Modal" plugin and the supported options (e.g. "remote").
	 */
	public $clientOptions = [];
	/**
	 * @var array the event handlers for the underlying JS plugin.
	 * Please refer to the corresponding plugin Web page for possible events.
	 * For example, [this page](http://www.getuikit.com/docs/components.html) shows
	 * how to use the "Modal" plugin and the supported events (e.g. "shown").
	 */
	public $clientEvents = [];

	/**
	 * Initializes the widget.
	 * This method will register the bootstrap asset bundle. If you override this method,
	 * make sure you call the parent implementation first.
	 */
	public function init()
	{
		parent::init();
		if (!isset($this->options['id'])) {
			$this->options['id'] = $this->getId();
		}
	}

	/**
	 * Registers a specific Bootstrap plugin and the related events
	 * @param string $name the name of the Bootstrap plugin
	 */
	protected function registerPlugin($name)
	{
		$view = $this->getView();

		UIkitPluginAsset::register($view);

		$id = $this->options['id'];

		if ($this->clientOptions !== false) {
			$options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
			$js = "jQuery('#$id').$name($options);";
			$view->registerJs($js);
		}

		if (!empty($this->clientEvents)) {
			$js = [];
			foreach ($this->clientEvents as $event => $handler) {
				$js[] = "jQuery('#$id').on('$event', $handler);";
			}
			$view->registerJs(implode("\n", $js));
		}
	}
}
