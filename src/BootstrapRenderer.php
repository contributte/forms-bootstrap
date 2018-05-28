<?php

/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://github.com/czubehead/bootstrap-4-forms
 * based on the original FormRenderer by David Grudl
 */

namespace Czubehead\BootstrapForms;

use Czubehead\BootstrapForms\Enums\RendererConfig as Cnf;
use Czubehead\BootstrapForms\Enums\RendererOptions;
use Czubehead\BootstrapForms\Enums\RenderMode;
use Czubehead\BootstrapForms\Grid\BootstrapRow;
use Czubehead\BootstrapForms\Inputs\IValidationInput;
use Nette;
use Nette\Utils\Html;


/**
 * Converts a Form into Bootstrap 4 HTML output.
 * @property int        $mode
 * @property string     $gridBreakPoint    Bootstrap grid breakpoint for side-by-side view. Default is 'sm'.
 *           NULL means not to use a breakpoint
 * @property-read array $config
 * @property-read array $configOverride
 */
class BootstrapRenderer implements Nette\Forms\IFormRenderer
{
	use Nette\SmartObject;

	const defaultLabelColumns = 3;
	const defaultControlColumns = 9;

	/**
	 * Bootstrap grid breakpoint for side-by-side view
	 * @var string
	 */
	protected $gridBreakPoint = 'sm';
	/** @var BootstrapForm */
	protected $form;
	/**
	 * @var int
	 */
	protected $labelColumns = self::defaultLabelColumns;
	/**
	 * @var int
	 */
	protected $controlColumns = self::defaultControlColumns;
	/**
	 * @var int current render mode
	 */
	private $renderMode = RenderMode::SideBySideMode;

	/**
	 * BootstrapRenderer constructor.
	 * @param int $mode
	 */
	public function __construct($mode = RenderMode::VerticalMode)
	{
		$this->setMode($mode);
	}

	/**
	 * Sets the form for which to render. Used only if a specific function of the renderer must be executed
	 * outside of render(), such as during assisted manual rendering.
	 * @param Nette\Forms\Form $form
	 */
	public function attachForm(Nette\Forms\Form $form)
	{
		$this->form = $form;
	}

	/**
	 * Turns configuration or and existing element and configures it appropriately
	 * @param $config array|string top-level config key
	 * @param $el     Html|null elem to config.
	 * @return Html|null
	 */
	public function configElem($config, $el = NULL)
	{
		if (is_scalar($config)) {
			$config = $this->fetchConfig($config);
		}

		// first define which element we want to work with
		if (isset($config[ Cnf::elementName ])) {
			$name = $config[ Cnf::elementName ];
			if (!$el) {
				// element does not exist, so create it
				$el = Html::el($name);
			} else {
				// element exists, but we want to change its name
				$el->setName($name);
			}
		}

		if ($el instanceof Html && $el != NULL) {
			// if el is defined, we can configure it accordingly

			// go through all config and configure element accordingly
			foreach ($config as $key => $value) {
				if (in_array($key, [Cnf::classSet, Cnf::classAdd, Cnf::classAdd, Cnf::classRemove])) {
					// we'll be working with classes, we must standardize everything to arrays, not strings for the sake of sanity
					if (!is_array($value)) {
						// configuration may contain classes as strings, but we always work with arrays
						$value = [$value];
					}

					$origClass = $el->getAttribute('class');
					$newClass = $origClass;
					if ($origClass === NULL) {
						// class is not set
						$newClass = [];
					} elseif (!is_array($origClass)) {
						// class is set, but not a array
						$newClass = explode(' ', $el->getAttribute('class'));
					}
					$el->setAttribute('class', $newClass);
					$origClass = $newClass;
				}

				if ($key == Cnf::classSet) {
					$el->setAttribute('class', $value);
				} elseif ($key == Cnf::classAdd) {
					$el->setAttribute(
						'class',
						array_merge($origClass, $value)
					);
				} elseif ($key == Cnf::classRemove) {
					$el->setAttribute(
						'class',
						array_diff($origClass, $value)
					);
				} elseif ($key == Cnf::attributes) {
					foreach ($value as $attr => $attrVal) {
						$el->setAttribute($attr, $attrVal);
					}
				}
			}
		}

		// el may be null, but maybe it has a container defined
		if (isset($config[ Cnf::container ])) {
			$container = $this->configElem($config[ Cnf::container ], NULL);
			if ($container !== NULL && $el !== NULL) {
				$elClone = clone $el;
				$container->setHtml($elClone);
			}
			$el = $container;
		}

		return $el;
	}

	public function getConfig()
	{
		return [
			Cnf::form       => [],
			Cnf::group      => [
				Cnf::elementName => 'fieldset',
			],
			Cnf::groupLabel => [
				Cnf::elementName => 'legend',
			],

			Cnf::gridRow  => [
				Cnf::elementName => 'div',
				Cnf::classSet    => 'form-row',
			],
			Cnf::gridCell => [
				Cnf::elementName => 'div',
			],

			Cnf::formOwnErrors => [],
			Cnf::formOwnError  => [
				Cnf::elementName => 'div',
				Cnf::classSet    => ['alert', 'alert-danger'],
			],

			Cnf::pair  => [
				Cnf::elementName => 'div',
				Cnf::classSet    => 'form-group',
			],
			Cnf::label => [
				Cnf::elementName => 'label',
			],

			Cnf::input        => [],
			// inputs which are normally inline elements (after bootstrap classes are applied)
			Cnf::inputValid   => [
				Cnf::classAdd => 'is-valid',
			],
			Cnf::inputInvalid => [
				Cnf::classAdd => 'is-invalid',
			],

			Cnf::description => [
				Cnf::elementName => 'small',
				Cnf::classSet    => ['form-text', 'text-muted'],
			],

			Cnf::feedback        => [
				Cnf::elementName => 'div',
			],
			Cnf::feedbackValid   => [
				Cnf::classAdd => 'valid-feedback',
			],
			Cnf::feedbackInvalid => [
				Cnf::classAdd => 'invalid-feedback',
			],

			// empty wrapper,  but it gets utilized in side-by side and inline mode
			Cnf::nonLabel        => [
				Cnf::elementName => NULL,
			],
		];
	}

	public function getConfigOverride()
	{
		if ($this->gridBreakPoint != NULL) {
			$labelColClass = "col-{$this->gridBreakPoint}-{$this->labelColumns}";
			$nonLabelColClass = "col-{$this->gridBreakPoint}-{$this->controlColumns}";
		} else {
			$labelColClass = "col-{$this->labelColumns}";
			$nonLabelColClass = "col-{$this->controlColumns}";
		}

		return [
			RenderMode::Inline         => [
				Cnf::form     => [
					Cnf::classAdd => 'form-inline',
				],
				Cnf::nonLabel => [
					Cnf::elementName => 'div',
				],
			],
			RenderMode::SideBySideMode => [
				Cnf::pair     => [
					Cnf::classAdd => 'row',
				],
				Cnf::label    => [
					Cnf::classAdd => $labelColClass,
				],
				Cnf::nonLabel => [
					Cnf::elementName => 'div',
					Cnf::classSet    => $nonLabelColClass,
				],
			],
			RenderMode::VerticalMode   => [
			],
		];
	}

	/**
	 * @return string
	 */
	public function getGridBreakPoint()
	{
		return $this->gridBreakPoint;
	}

	/**
	 * @param string $gridBreakPoint null for none
	 * @return BootstrapRenderer
	 */
	public function setGridBreakPoint($gridBreakPoint)
	{
		$this->gridBreakPoint = $gridBreakPoint;

		return $this;
	}

	/**
	 * Returns render mode
	 * @return int
	 * @see RenderMode
	 */
	public function getMode()
	{
		return $this->renderMode;
	}

	/**
	 * Provides complete form rendering.
	 * @param \Nette\Forms\Form $form
	 * @param null              $mode
	 * @return string
	 */
	public function render(Nette\Forms\Form $form, $mode = NULL)
	{
		$this->attachForm($form);

		$s = '';
		$s .= $this->renderBegin();
		$s .= $this->renderFeedback();
		$s .= $this->renderBody();
		$s .= $this->renderEnd();

		return $s;
	}

	/**
	 * Renders form begin.
	 * @return string
	 */
	public function renderBegin()
	{
		foreach ($this->form->getControls() as $control) {
			$control->setOption(RendererOptions::_rendered, FALSE);
		}

		$prototype = $this->form->getElementPrototype();
		$prototype = $this->configElem('form', $prototype);

		if ($this->form->isMethod('get')) {
			$el = $prototype;
			/** @noinspection PhpUndefinedFieldInspection */
			$query = parse_url($el->action, PHP_URL_QUERY);
			/** @noinspection PhpUndefinedFieldInspection */
			$el->action = str_replace("?$query", '', $el->action);
			$s = '';
			foreach (preg_split('#[;&]#', $query, NULL, PREG_SPLIT_NO_EMPTY) as $param) {
				$parts = explode('=', $param, 2);
				$name = urldecode($parts[0]);
				if (!isset($this->form[ $name ])) {
					$s .= Html::el('input', ['type' => 'hidden', 'name' => $name, 'value' => urldecode($parts[1])]);
				}
			}

			return $el->startTag() . "\n$s";
		} else {
			return $prototype->startTag();
		}
	}

	/**
	 * Renders form body.
	 * @return string
	 */
	public function renderBody()
	{
		$translator = $this->form->getTranslator();

		// first render groups. They will mark their controls as rendered
		$groups = Html::el();
		foreach ($this->form->getGroups() as $group) {
			if (!$group->getControls() || !$group->getOption(RendererOptions::visual)) {
				continue;
			}

			//region getting container
			$container = $group->getOption(RendererOptions::container, NULL);
			if (is_string($container)) {
				$container = $this->configElem(Cnf::group, Html::el($container));
			} elseif ($container instanceof Html) {
				$container = $this->configElem(Cnf::group, $container);
			} else {
				$container = $this->getElem(Cnf::group);
			}

			$container->setAttribute('id', $group->getOption(RendererOptions::id));

			//endregion

			//region label
			$label = $group->getOption(RendererOptions::label);
			if ($label instanceof Html) {
				$label = $this->configElem(Cnf::groupLabel, $label);
			} elseif (is_string($label)) {
				if ($translator !== NULL) {
					$label = $translator->translate($label);
				}
				$labelHtml = $this->getElem(Cnf::groupLabel);
				$labelHtml->setText($label);
				$label = $labelHtml;
			}
			//endregion

			if (!empty($label)) {
				$container->addHtml($label);
			}

			$controls = $this->renderControls($group);
			if (!empty($controls)) {
				$container->addHtml($controls);
			}

			$groups->addHtml($container);
		}
		// we now know which ones to skip, so render the rest
		$formControls = $this->renderControls($this->form);

		$out = Html::el();
		if (!empty($formControls)) {
			$out->addHtml($formControls);
		}
		if (!empty($groups)) {
			$out->addHtml($groups);
		}

		return $out;
	}

	/**
	 * Renders 'control' part of visual row of controls.
	 * @param \Nette\Forms\IControl $control
	 * @return string
	 */
	public function renderControl(Nette\Forms\IControl $control)
	{
		/** @noinspection PhpUndefinedMethodInspection */
		$controlHtml = $control->getControl();
		/** @noinspection PhpUndefinedMethodInspection */
		$control->setOption(RendererOptions::_rendered, TRUE);
		/** @noinspection PhpUndefinedMethodInspection */
		if (($this->form->showValidation || $control->hasErrors()) && $control instanceof IValidationInput) {
			$controlHtml = $control->showValidation($controlHtml);
		}
		$controlHtml = $this->configElem(Cnf::input, $controlHtml);

		return $controlHtml;
	}

	/**
	 * Renders group of controls.
	 * @param  Nette\Forms\Container|Nette\Forms\ControlGroup
	 * @return string
	 */
	public function renderControls($parent)
	{
		if (!($parent instanceof Nette\Forms\Container || $parent instanceof Nette\Forms\ControlGroup)) {
			throw new Nette\InvalidArgumentException('Argument must be Nette\Forms\Container or Nette\Forms\ControlGroup instance.');
		}
		$html = Html::el();
		$hidden = Html::el();

		// note that these are NOT form groups, these are groups specified to group
		foreach ($parent->getControls() as $control) {
			if ($control->getOption(RendererOptions::_rendered, FALSE)) {
				continue;
			}

			if ($control instanceof BootstrapRow) {
				$html->addHtml($control->render());
			} else {
				if ($control->getOption(RendererOptions::type) == 'hidden') {
					$hidden->addHtml($this->renderControl($control));
				} else {
					$pairHtml = $this->renderPair($control);
					$html->addHtml($pairHtml);
				}
			}
		}

		$html->addHtml($hidden);

		return $html;
	}

	/**
	 * Renders form end.
	 * @return string
	 */
	public function renderEnd()
	{
		return $this->form->getElementPrototype()->endTag() . "\n";
	}

	/**
	 * Renders 'label' part of visual row of controls.
	 * @param \Nette\Forms\IControl $control
	 * @return Html
	 */
	public function renderLabel(Nette\Forms\IControl $control)
	{
		/** @noinspection PhpUndefinedMethodInspection */
		$controlLabel = $control->getLabel();
		if ($controlLabel instanceof Html && $controlLabel->getName() == 'label') {
			// the control has already provided us with the element, no need to create our own
			$controlLabel = $this->configElem(Cnf::label, $controlLabel);
			// just configure it to suit our needs

			$labelHtml = $controlLabel;
		} elseif ($controlLabel === NULL) {
			return Html::el();
		} else {
			// the control doesn't give us <label>, se we'll create our own
			$labelHtml = $this->getElem(Cnf::label);
			if ($controlLabel) {
				$labelHtml->setHtml($controlLabel);
			}
		}

		return $labelHtml;
	}

	/**
	 * Renders single visual row.
	 * @param \Nette\Forms\IControl $control
	 * @return string
	 */
	public function renderPair(Nette\Forms\IControl $control)
	{
		$pairHtml = $this->configElem(Cnf::pair);
		/** @noinspection PhpUndefinedMethodInspection */
		/** @noinspection PhpUndefinedFieldInspection */
		$pairHtml->id = $control->getOption(RendererOptions::id);

		$labelHtml = $this->renderLabel($control);
		if (!empty($labelHtml)) {
			$pairHtml->addHtml($labelHtml);
		}

		$nonLabel = $this->getElem(Cnf::nonLabel);

		//region non-label parts
		$controlHtml = $this->renderControl($control);
		$feedbackHtml = $this->renderFeedback($control);
		$descriptionHtml = $this->renderDescription($control);

		if (!empty($controlHtml)) {
			$nonLabel->addHtml($controlHtml);
		}
		if (!empty($feedbackHtml)) {
			$nonLabel->addHtml($feedbackHtml);
		}
		if (!empty($descriptionHtml)) {
			$nonLabel->addHtml($descriptionHtml);
		}
		//endregion

		if (!empty($nonLabel)) {
			$pairHtml->addHtml($nonLabel);
		}

		return $pairHtml->render(0);
	}

	/**
	 * Set how many of Bootstrap rows shall the label and control occupy
	 * @param int      $label
	 * @param int|null $control
	 */
	public function setColumns($label, $control = NULL)
	{
		if ($control === NULL) {
			$control = 12 - $label;
		}

		$this->labelColumns = $label;
		$this->controlColumns = $control;
	}

	/**
	 * Sets render mode
	 * @param int $renderMode RenderMode
	 * @see RenderMode
	 */
	public function setMode($renderMode)
	{
		$this->renderMode = $renderMode;
	}

	/**
	 * Fetch config tailored for current render mode
	 * @param string $key first-level key of $this->config
	 * @return array
	 */
	protected function fetchConfig($key)
	{
		$config = $this->config[ $key ];

		if (isset($this->configOverride[ $this->renderMode ][ $key ])) {
			$override = $this->configOverride[ $this->renderMode ][ $key ];
			$config = array_merge($config, $override);
		}

		return $config;
	}

	/**
	 * Get element based on its first-level key
	 * @param       $key
	 * @param array ...$additionalKeys config will be overridden in this order
	 * @return Html|null
	 */
	protected function getElem($key, ...$additionalKeys)
	{
		$el = $this->configElem($key, Html::el());

		foreach ($additionalKeys as $additionalKey) {
			$config = $this->fetchConfig($additionalKey);
			$el = $this->configElem($config, $el);
		}

		return $el;
	}

	/**
	 * Renders control description (help text)
	 * @param Nette\Forms\IControl $control
	 * @return Html|null
	 */
	protected function renderDescription(Nette\Forms\IControl $control)
	{
		/** @noinspection PhpUndefinedMethodInspection */
		$description = $control->getOption(RendererOptions::description);
		if (is_string($description)) {
			if ($control instanceof Nette\Forms\Controls\BaseControl) {
				$description = $control->translate($description);
			}
		} elseif (!$description instanceof Html) {
			$description = '';
		}

		if (!empty($description)) {
			$el = $this->getElem(Cnf::description);
			$el->setHtml($description);

			return $el;
		} else {
			return NULL;
		}
	}

	/**
	 * Renders valid or invalid feedback of form or control
	 * @param Nette\Forms\Controls\BaseControl|null $control null = whole form
	 * @return Html|null
	 */
	protected function renderFeedback($control = NULL)
	{
		$validationHtml = NULL;
		$isValid = TRUE;
		$showFeedback = FALSE;
		$messages = [];

		if ($control instanceof Nette\Forms\IControl) {
			// specific control

			if ($control->hasErrors()) {
				// control is invalid, mark it that way
				$isValid = FALSE;
				$showFeedback = TRUE;
				$messages = $control->getErrors();
			} elseif ($this->form->showValidation) {
				$isValid = TRUE;
				// control is valid and we want to explicitly show that it's valid
				$message = $control->getOption(RendererOptions::feedbackValid);
				if ($message) {
					$messages = [$message];
					$showFeedback = TRUE;
				} else {
					$showFeedback = FALSE;
				}
			}

			if ($showFeedback && count($messages)) {
				$el = $isValid
					? $this->getElem(Cnf::feedback, Cnf::feedbackValid)
					: $this->getElem(Cnf::feedback, Cnf::feedbackInvalid);

				foreach ($messages as $message) {
					if ($message instanceof Html) {
						$el->addHtml($message);
					} else {
						$el->addText($message);
					}
					$el->addHtml('<br>');
				}

				return $el;
			} else {
				return NULL;
			}
		} elseif ($control === NULL) {
			// whole form
			$form = $this->form;

			if ($form->hasErrors()) {
				$showFeedback = TRUE;
				$messages = $form->getOwnErrors();
			} else {
				$showFeedback = FALSE;
				// this doesn't make sense, form is sent if it's valid
			}

			if ($showFeedback && count($messages)) {
				$el = $this->getElem(Cnf::formOwnErrors);
				$msgTemplate = $this->getElem(Cnf::formOwnError);

				foreach ($messages as $message) {
					$messageHtml = clone $msgTemplate;
					if ($message instanceof Html) {
						$messageHtml->setHtml($message);
					} else {
						$messageHtml->setText($message);
					}

					$el->addHtml($messageHtml);
				}

				return $el;
			} else {
				return NULL;
			}
		} else {
			throw new Nette\NotImplementedException('renderer is unable to render feedback for ' . gettype($control));
		}
	}
}
