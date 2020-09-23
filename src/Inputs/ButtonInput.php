<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\Traits\BootstrapButtonTrait;
use Nette\Forms\Controls\Button;
use Nette\Utils\Html;

/**
 * Class ButtonInput.
 * Returns &lt;button&gt; whose content can be set as caption. This is not a submit button.
 *
 * @property string $btnClass
 */
class ButtonInput extends Button
{

	use BootstrapButtonTrait;

	/**
	 * @param string|Html|null $content
	 */
	public function __construct($content = null)
	{
		parent::__construct($content);
	}

	/**
	 * Control HTML
	 *
	 * @param string|Html|null $content
	 */
	public function getControl($content = null): Html
	{
		$btn = Html::el('button', [
			'type' => 'button',
			'name' => $this->getHtmlName(),
		]);
		$btn->setHtml($content ?? (string) $this->caption);
		$this->addBtnClass($btn);

		return $btn;
	}

}
