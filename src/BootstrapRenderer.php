<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap;

use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\FormsBootstrap\Enums\RendererConfig as Cnf;
use Contributte\FormsBootstrap\Enums\RendererOptions;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Contributte\FormsBootstrap\Grid\BootstrapRow;
use Contributte\FormsBootstrap\Inputs\IValidationInput;
use Nette;
use Nette\Forms\Control;
use Nette\Forms\Controls\BaseControl;
use Nette\Forms\Form;
use Nette\Forms\FormRenderer;
use Nette\Utils\Html;

/**
 * Converts a Form into Bootstrap 4 HTML output.
 *
 * @property int        $mode
 * @property string     $gridBreakPoint    Bootstrap grid breakpoint for side-by-side view. Default is 'sm'.
 *           NULL means not to use a breakpoint
 * @property-read array $config
 * @property-read array $configOverride
 * @property bool       $groupHidden       if true, hidden fields will be grouped at the end. If false,
 *           hidden fields are placed where they were added. Default is true.
 */
class BootstrapRenderer implements FormRenderer
{

	use Nette\SmartObject;

	public const DEFAULT_LABEL_COLUMNS = 3;
	public const DEFAULT_CONTROL_COLUMNS = 9;

	/**
	 * Bootstrap grid breakpoint for side-by-side view
	 *
	 * @var string
	 */
	protected $gridBreakPoint = 'sm';

	/** @var BootstrapForm */
	protected $form;

	/** @var int */
	protected $labelColumns = self::DEFAULT_LABEL_COLUMNS;

	/** @var int */
	protected $controlColumns = self::DEFAULT_CONTROL_COLUMNS;

	/** @var int current render mode */
	private $renderMode = RenderMode::SIDE_BY_SIDE_MODE;

	/** @var bool */
	private $groupHidden = true;

	public function __construct(int $mode = RenderMode::VERTICAL_MODE)
	{
		$this->setMode($mode);
	}

	/**
	 * Sets the form for which to render. Used only if a specific function of the renderer must be executed
	 * outside of render(), such as during assisted manual rendering.
	 */
	public function attachForm(BootstrapForm $form): void
	{
		$this->form = $form;
	}

	/**
	 * Turns configuration or and existing element and configures it appropriately
	 *
	 * @param string[]|string $config top-level config key
	 * @param Html|null $el elem to config.
	 */
	public function configElem($config, ?Html $el = null): ?Html
	{
		if (is_scalar($config)) {
			$config = $this->fetchConfig($config);
		}

		// first define which element we want to work with
		if (isset($config[Cnf::ELEMENT_NAME])) {
			$name = $config[Cnf::ELEMENT_NAME];
			if (!$el) {
				// element does not exist, so create it
				$el = Html::el($name);
			} else {
				// element exists, but we want to change its name
				$el->setName($name);
			}
		}

		if ($el instanceof Html && $el !== null) {
			$origClass = null;
			// go through all config and configure element accordingly
			foreach ($config as $key => $value) {
				if (in_array($key, [Cnf::CLASS_SET, Cnf::CLASS_ADD, Cnf::CLASS_ADD, Cnf::CLASS_REMOVE])) {
					// we'll be working with classes, we must standardize everything to arrays, not strings for the sake of sanity
					if (!is_array($value)) {
						// configuration may contain classes as strings, but we always work with arrays
						$value = [$value];
					}

					$origClass = $el->getAttribute('class');
					$newClass = $origClass;
					if ($origClass === null) {
						// class is not set
						$newClass = [];
					} elseif (!is_array($origClass)) {
						// class is set, but not a array
						$newClass = explode(' ', $el->getAttribute('class'));
					}

					$el->setAttribute('class', $newClass);
					$origClass = $newClass;
				}

				if ($key === Cnf::CLASS_SET) {
					$el->setAttribute('class', $value);
				} elseif ($key === Cnf::CLASS_ADD) {
					$el->setAttribute(
						'class',
						array_merge($origClass, $value)
					);
				} elseif ($key === Cnf::CLASS_REMOVE) {
					$el->setAttribute(
						'class',
						array_diff($origClass, $value)
					);
				} elseif ($key === Cnf::ATTRIBUTES) {
					foreach ($value as $attr => $attrVal) {
						$el->setAttribute($attr, $attrVal);
					}
				}
			}
		}

		// el may be null, but maybe it has a container defined
		if (isset($config[Cnf::CONTAINER])) {
			$container = $this->configElem($config[Cnf::CONTAINER], null);
			if ($container !== null && $el !== null) {
				$elClone = clone $el;
				$container->setHtml($elClone);
			}

			$el = $container;
		}

		return $el;
	}

	/**
	 * @return mixed[]
	 */
	public function getConfig(): array
	{
		return [
			Cnf::FORM       => [],
			Cnf::GROUP      => [
				Cnf::ELEMENT_NAME => 'fieldset',
			],
			Cnf::GROUP_LABEL => [
				Cnf::ELEMENT_NAME => 'legend',
			],

			Cnf::GRID_ROW  => [
				Cnf::ELEMENT_NAME => 'div',
				Cnf::CLASS_SET    => BootstrapForm::getBootstrapVersion() === BootstrapVersion::V5 ? 'row' : 'form-row',
			],
			Cnf::GRID_CELL => [
				Cnf::ELEMENT_NAME => 'div',
			],

			Cnf::FORM_OWN_ERRORS => [],
			Cnf::FORM_OWN_ERROR  => [
				Cnf::ELEMENT_NAME => 'div',
				Cnf::CLASS_SET    => ['alert', 'alert-danger'],
			],

			Cnf::PAIR  => [
				Cnf::ELEMENT_NAME => 'div',
				Cnf::CLASS_SET    => BootstrapForm::getBootstrapVersion() === BootstrapVersion::V5 ? 'mb-3' : 'form-group',
			],
			Cnf::LABEL => [
				Cnf::ELEMENT_NAME => 'label',
				Cnf::CLASS_SET    => BootstrapForm::getBootstrapVersion() === BootstrapVersion::V5 ? 'form-label' : null,
			],

			Cnf::INPUT        => [],
			// inputs which are normally inline elements (after bootstrap classes are applied)
			Cnf::INPUT_VALID   => [
				Cnf::CLASS_ADD => 'is-valid',
			],
			Cnf::INPUT_INVALID => [
				Cnf::CLASS_ADD => 'is-invalid',
			],

			Cnf::DESCRIPTION => [
				Cnf::ELEMENT_NAME => 'small',
				Cnf::CLASS_SET    => ['form-text', 'text-muted'],
			],

			Cnf::FEEDBACK        => [
				Cnf::ELEMENT_NAME => 'div',
			],
			Cnf::FEEDBACK_VALID   => [
				Cnf::CLASS_ADD => 'valid-feedback',
			],
			Cnf::FEEDBACK_INVALID => [
				Cnf::CLASS_ADD => 'invalid-feedback',
			],

			// empty wrapper,  but it gets utilized in side-by side and inline mode
			Cnf::NON_LABEL        => [
				Cnf::ELEMENT_NAME => null,
			],
		];
	}

	/**
	 * @return mixed[]
	 */
	public function getConfigOverride(): array
	{
		if ($this->gridBreakPoint !== null) {
			$labelColClass = 'col-' . $this->gridBreakPoint . '-' . $this->labelColumns;
			$nonLabelColClass = 'col-' . $this->gridBreakPoint . '-' . $this->controlColumns;
		} else {
			$labelColClass = 'col-' . $this->labelColumns;
			$nonLabelColClass = 'col-' . $this->controlColumns;
		}

		$labelColClass .= ' col-form-label';

		return [
			RenderMode::INLINE         => [
				Cnf::FORM     => [
					Cnf::CLASS_ADD => 'form-inline',
				],
				Cnf::NON_LABEL => [
					Cnf::ELEMENT_NAME => 'div',
				],
			],
			RenderMode::SIDE_BY_SIDE_MODE => [
				Cnf::PAIR     => [
					Cnf::CLASS_ADD => 'row',
				],
				Cnf::LABEL    => [
					Cnf::CLASS_ADD => $labelColClass,
				],
				Cnf::NON_LABEL => [
					Cnf::ELEMENT_NAME => 'div',
					Cnf::CLASS_SET    => $nonLabelColClass,
				],
			],
			RenderMode::VERTICAL_MODE   => [],
		];
	}

	public function getGridBreakPoint(): string
	{
		return $this->gridBreakPoint;
	}

	/**
	 * @param string $gridBreakPoint null for none
	 */
	public function setGridBreakPoint(string $gridBreakPoint): BootstrapRenderer
	{
		$this->gridBreakPoint = $gridBreakPoint;

		return $this;
	}

	/**
	 * Returns render mode
	 *
	 * @see RenderMode
	 */
	public function getMode(): int
	{
		return $this->renderMode;
	}

	/**
	 * @see BootstrapRenderer::$groupHidden
	 */
	public function isGroupHidden(): bool
	{
		return $this->groupHidden;
	}

	/**
	 * @see BootstrapRenderer::$groupHidden
	 */
	public function setGroupHidden(bool $groupHidden): BootstrapRenderer
	{
		$this->groupHidden = $groupHidden;

		return $this;
	}

	/**
	 * Provides complete form rendering.
	 *
	 * @param BootstrapForm $form
	 */
	public function render(Form $form): string
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
	 */
	public function renderBegin(): string
	{
		foreach ($this->form->getControls() as $control) {
			$control->setOption(RendererOptions::_RENDERED, false);
		}

		/** @var Html $el */
		$el = $this->configElem('form', $this->form->getElementPrototype());

		if ($this->form->isMethod('get')) {
			$el->action = (string) $el->action;
			/** @noinspection PhpUndefinedFieldInspection */
			$query = parse_url($el->action, PHP_URL_QUERY);
			/** @noinspection PhpUndefinedFieldInspection */
			$el->action = str_replace('?' . $query, '', $el->action);

			$s = '';
			$params = ($query === null || $query === false)
				? []
				: (preg_split('#[;&]#', $query, -1, PREG_SPLIT_NO_EMPTY) ?: []);
			foreach ($params as $param) {
				$parts = explode('=', $param, 2);
				$name = urldecode($parts[0]);
				if (!isset($this->form[$name])) {
					$s .= Html::el('input', ['type' => 'hidden', 'name' => $name, 'value' => urldecode($parts[1])]);
				}
			}

			return $el->startTag() . PHP_EOL . $s;
		}

		return $el->startTag();
	}

	/**
	 * Renders form body.
	 */
	public function renderBody(): string
	{
		$translator = $this->form->getTranslator();

		// first render groups. They will mark their controls as rendered
		$groups = Html::el();
		foreach ($this->form->getGroups() as $group) {
			if (!$group->getControls() || !$group->getOption(RendererOptions::VISUAL)) {
				continue;
			}

			//region getting container

			$container = $group->getOption(RendererOptions::CONTAINER, null);
			if (is_string($container)) {
				$container = $this->configElem(Cnf::GROUP, Html::el($container));
			} elseif ($container instanceof Html) {
				$container = $this->configElem(Cnf::GROUP, $container);
			} else {
				$container = $this->getElem(Cnf::GROUP);
			}

			$container->setAttribute('id', $group->getOption(RendererOptions::ID));

			//endregion

			//region label
			$label = $group->getOption(RendererOptions::LABEL);
			if ($label instanceof Html) {
				$label = $this->configElem(Cnf::GROUP_LABEL, $label);
			} elseif (is_string($label)) {
				if ($translator !== null) {
					$label = $translator->translate($label);
				}

				$labelHtml = $this->getElem(Cnf::GROUP_LABEL);
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

		return (string) $out;
	}

	/**
	 * Renders 'control' part of visual row of controls.
	 */
	public function renderControl(BaseControl $control): string
	{
		/** @var Html $controlHtml */
		$controlHtml = $control->getControl();
		$control->setOption(RendererOptions::_RENDERED, true);
		if (($this->form->showValidation || $control->hasErrors()) && $control instanceof IValidationInput) {
			$controlHtml = $control->showValidation($controlHtml);
		}

		$controlHtml = $this->configElem(Cnf::INPUT, $controlHtml);

		return (string) $controlHtml;
	}

	/**
	 * Renders group of controls.
	 *
	 * @param  Nette\Forms\Container|Nette\Forms\ControlGroup $parent
	 */
	public function renderControls($parent): string
	{
		if (!($parent instanceof Nette\Forms\Container || $parent instanceof Nette\Forms\ControlGroup)) {
			throw new Nette\InvalidArgumentException('Argument must be Nette\Forms\Container or Nette\Forms\ControlGroup instance.');
		}

		$html = Html::el();
		$hidden = Html::el();

		// note that these are NOT form groups, these are groups specified to group
		foreach ($parent->getControls() as $control) {
			if ($control->getOption(RendererOptions::_RENDERED, false)) {
				continue;
			}

			if ($control instanceof BootstrapRow) {
				$html->addHtml($control->render());
			} else {
				if ($control->getOption(RendererOptions::TYPE) === 'hidden') {
					$isHidden = true;
					$pairHtml = $this->renderControl($control);
				} else {
					$pairHtml = $this->renderPair($control);
					$isHidden = false;
				}

				if ($this->groupHidden && $isHidden) {
					$hidden->addHtml($pairHtml);
				} else {
					$html->addHtml($pairHtml);
				}
			}
		}

		$html->addHtml($hidden);

		return (string) $html;
	}

	/**
	 * Renders form end.
	 */
	public function renderEnd(): string
	{
		return $this->form->getElementPrototype()->endTag() . "\n";
	}

	/**
	 * Renders 'label' part of visual row of controls.
	 */
	public function renderLabel(BaseControl $control): Html
	{
		if ($control->caption === null) {
			return Html::el();
		}

		$controlLabel = $control->getLabel();

		if ($controlLabel instanceof Html && $controlLabel->getName() === 'label') {
			// the control has already provided us with the element, no need to create our own
			$controlLabel = $this->configElem(Cnf::LABEL, $controlLabel);
			// just configure it to suit our needs

			return $controlLabel;
		}

		if ($controlLabel === null) {
			if (method_exists($control, 'allignWithInputControls') && $control->allignWithInputControls()) {
				return $this->configElem(Cnf::LABEL, null);
			}

			return Html::el();
		}

		// the control doesn't give us <label>, se we'll create our own
		$labelHtml = $this->getElem(Cnf::LABEL);
		if ($controlLabel) {
			$labelHtml->setHtml($controlLabel);
		}

		return $labelHtml;
	}

	/**
	 * Renders single visual row.
	 */
	public function renderPair(BaseControl $control): string
	{
		$pairHtml = $this->configElem(Cnf::PAIR);

		$pairHtml->id = $control->getOption(RendererOptions::ID);

		$labelHtml = $this->renderLabel($control);
		if (!empty($labelHtml)) {
			$pairHtml->addHtml($labelHtml);
		}

		$nonLabel = $this->getElem(Cnf::NON_LABEL);

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
	 */
	public function setColumns(int $label, ?int $control = null): void
	{
		if ($control === null) {
			$control = 12 - $label;
		}

		$this->labelColumns = $label;
		$this->controlColumns = $control;
	}

	/**
	 * Sets render mode
	 *
	 * @param int $renderMode RenderMode
	 * @see RenderMode
	 */
	public function setMode(int $renderMode): void
	{
		$this->renderMode = $renderMode;
	}

	/**
	 * Fetch config tailored for current render mode
	 *
	 * @param string $key first-level key of $this->config
	 * @return mixed[]
	 */
	protected function fetchConfig(string $key): array
	{
		$config = $this->config[$key];

		if (isset($this->configOverride[$this->renderMode][$key])) {
			$override = $this->configOverride[$this->renderMode][$key];
			$config = array_merge($config, $override);
		}

		return $config;
	}

	/**
	 * Get element based on its first-level key
	 *
	 * @param string $additionalKeys config will be overridden in this order
	 */
	protected function getElem(string $key, ...$additionalKeys): ?Html
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
	 */
	protected function renderDescription(BaseControl $control): ?Html
	{
		$description = $control->getOption(RendererOptions::DESCRIPTION);
		if (is_string($description)) {
			if ($control instanceof BaseControl) {
				$description = $control->translate($description);
			}
		} elseif (!$description instanceof Html) {
			$description = '';
		}

		if (!empty($description)) {
			$el = $this->getElem(Cnf::DESCRIPTION);
			$el->setHtml($description);

			return $el;
		}

		return null;
	}

	/**
	 * Renders valid or invalid feedback of form or control
	 *
	 * @param BaseControl|null $control null = whole form
	 */
	protected function renderFeedback(?BaseControl $control = null): ?Html
	{
		$isValid = true;
		$showFeedback = false;
		$messages = [];

		if ($control instanceof Control) {
			// specific control

			if ($control->hasErrors()) {
				// control is invalid, mark it that way
				$isValid = false;
				$showFeedback = true;
				$messages = $control->getErrors();
			} elseif ($this->form->showValidation) {
				$isValid = true;
				// control is valid and we want to explicitly show that it's valid
				$message = $control->getOption(RendererOptions::FEEDBACK_VALID);
				if ($message) {
					$messages = [$message];
					$showFeedback = true;
				} else {
					$showFeedback = false;
				}
			}

			if ($showFeedback && count($messages)) {
				$el = $isValid
					? $this->getElem(Cnf::FEEDBACK, Cnf::FEEDBACK_VALID)
					: $this->getElem(Cnf::FEEDBACK, Cnf::FEEDBACK_INVALID);

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
				return null;
			}
		} elseif ($control === null) {
			// whole form
			$form = $this->form;

			if ($form->hasErrors()) {
				$showFeedback = true;
				$messages = $form->getOwnErrors();
			} else {
				$showFeedback = false;
				// this doesn't make sense, form is sent if it's valid
			}

			if ($showFeedback && count($messages)) {
				$el = $this->getElem(Cnf::FORM_OWN_ERRORS);
				$msgTemplate = $this->getElem(Cnf::FORM_OWN_ERROR);

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
				return null;
			}
		} else {
			throw new Nette\NotImplementedException('renderer is unable to render feedback for ' . gettype($control));
		}
	}

}
