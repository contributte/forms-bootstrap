<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\FormsBootstrap\Enums\RendererConfig;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\UploadControl;
use Nette\Utils\Html;

/**
 * Class UploadInput. Single or multi upload of files.
 *
 * @property string $buttonCaption the text on the left part of the button, NOT label.
 */
class UploadInput extends UploadControl implements IValidationInput
{

	/** @var string */
	private $buttonCaption;

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
		/** @var Html $control */
		$control = parent::getControl();
		$control->class = trim($control->class .= BootstrapForm::getBootstrapVersion() === BootstrapVersion::V5 ? ' form-control' : ' custom-file-input');

		$el = Html::el('div', ['class' => [BootstrapForm::getBootstrapVersion() === BootstrapVersion::V5 ? null : 'custom-file']]);
		$el->addHtml($control);
		$el->addHtml(
			Html::el('label', [
				'class' => [BootstrapForm::getBootstrapVersion() === BootstrapVersion::V5 ? 'form-label' : 'custom-file-label'],
				'for'   => $this->getHtmlId(),
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

		/** @var Form $form */
		$form = $this->getForm();
		/** @var BootstrapRenderer $renderer */
		$renderer = $form->getRenderer();

		$renderer->configElem(
			$this->hasErrors() ? RendererConfig::INPUT_INVALID : RendererConfig::INPUT_VALID,
			$input
		);

		return $control;
	}

}
