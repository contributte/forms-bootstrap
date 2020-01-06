<?php

namespace Contributte\FormsBootstrap\Inputs;


use Contributte\FormsBootstrap\Traits\BootstrapButtonTrait;
use Nette\Forms\Controls\Button;
use Nette\Utils\Html;


/**
 * Class ButtonInput.
 * Returns &lt;button&gt; whose content can be set as caption. This is not a submit button.
 * @package Contributte\FormsBootstrap
 * @property string $btnClass
 */
class ButtonInput extends Button
{
	use BootstrapButtonTrait;

	/**
	 * ButtonInput constructor.
	 * @param null|string|Html $content
	 */
	public function __construct($content = NULL)
	{
		parent::__construct($content);
	}

	/**
	 * Control HTML
	 * @param null|string|Html $content
	 * @return Html
	 */
	public function getControl($content = NULL): Html
	{
		$btn = Html::el('button', [
			'type' => 'button',
			'name' => $this->getHtmlName(),
		]);
		$btn->setHtml($content === NULL ? $this->caption : $content);
		$this->addBtnClass($btn);

		return $btn;
	}
}
