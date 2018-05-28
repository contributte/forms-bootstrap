<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://github.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms\Inputs;


use Czubehead\BootstrapForms\BootstrapRenderer;
use Czubehead\BootstrapForms\Enums\RendererConfig;
use Nette\Forms\Controls\UploadControl;
use Nette\Utils\Html;


/**
 * Class UploadInput. Single or multi upload of files.
 * @package Czubehead\BootstrapForms\Inputs
 * @property string $buttonCaption the text on the left part of the button, NOT label.
 */
class UploadInput extends UploadControl implements IValidationInput
{
	/**
	 * @var string
	 */
	private $buttonCaption;

	/**
	 * @return string
	 * @see UploadInput::$buttonCaption
	 */
	public function getButtonCaption()
	{
		return $this->buttonCaption;
	}

	/**
	 * the text on the left part of the button
	 * @param string $buttonCaption
	 * @return static
	 * @see UploadInput::$buttonCaption
	 */
	public function setButtonCaption($buttonCaption)
	{
		$this->buttonCaption = $buttonCaption;

		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getControl()
	{
		$control = parent::getControl();
		$control->class = 'custom-file-input';

		$el = Html::el('div', ['class' => ['custom-file']]);
		$el->addHtml($control);
		$el->addHtml(
			Html::el('label', [
				'class' => ['custom-file-label'],
				'for'   => $this->getHtmlId(),
			])->setText($this->buttonCaption)
		);

		return $el;
	}

	/**
	 * Modify control in such a way that it explicitly shows its validation state.
	 * Returns the modified element.
	 * @param Html $control
	 * @return Html
	 */
	public function showValidation(Html $control)
	{
		$input = $control->getChildren()[0];

		/** @var BootstrapRenderer $renderer */
		$renderer = $this->getForm()->getRenderer();

		$renderer->configElem(
			$this->hasErrors() ? RendererConfig::inputInvalid : RendererConfig::inputValid,
			$input
		);

		return $control;
	}
}
