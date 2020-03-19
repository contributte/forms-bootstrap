<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\RendererConfig;
use Nette\Forms\Controls\UploadControl;
use Nette\Utils\Html;

/**
 * Class UploadInput. Single or multi upload of files.
 *
 * @property string $buttonCaption the text on the left part of the button, NOT label.
 * @property string $browseButtonCaption the text on Browse button, NOT label
 */
class UploadInput extends UploadControl implements IValidationInput
{

	/** @var string */
	private $buttonCaption;
	
	/** @var string */
	private $browseButtonCaption = "Browse";

	public function setBrowseButtonCaption(string $browseButtonCaption)
	{
		$this->browseButtonCaption = $browseButtonCaption;
		return $this;
	}
		
	public function getBrowseButtonCaption(): string
	{
		return $this->browseButtonCaption;
	}	
		
	/**
	 * @see UploadInput::$buttonCaption
	 */
	public function getButtonCaption(): string
	{
		return $this->buttonCaption;
	}

	/**
	 * the text on the left part of the button
	 *
	 * @return static
	 * @see UploadInput::$buttonCaption
	 */
	public function setButtonCaption(string $buttonCaption)
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
				'data-browse' => $this->browseButtonCaption
			])->setText($this->buttonCaption)
		);

		return $el;
	}

	/**
	 * Modify control in such a way that it explicitly shows its validation state.
	 * Returns the modified element.
	 */
	public function showValidation(Html $control): Html
	{
		$input = $control->getChildren()[0];

		/** @var BootstrapRenderer $renderer */
		$renderer = $this->getForm()->getRenderer();

		$renderer->configElem(
			$this->hasErrors() ? RendererConfig::INPUT_INVALID : RendererConfig::INPUT_VALID,
			$input
		);

		return $control;
	}

}
