<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://github.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms\Inputs;


use Czubehead\BootstrapForms\Traits\BootstrapButtonTrait;
use Nette\Forms\Controls\Button;
use Nette\Utils\Html;


/**
 * Class ButtonInput.
 * Returns &lt;button&gt; whose content can be set as caption.
 * @package Czubehead\BootstrapForms
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
	 * @param null|string|Html $content
	 * @return Html
	 */
	public function getControl($content = NULL)
	{
		$btn = Html::el('button', [
			'type' => 'button',
		]);
		$btn->setHtml($content === NULL ? $this->caption : $content);
		$this->addBtnClass($btn);

		return $btn;
	}
}