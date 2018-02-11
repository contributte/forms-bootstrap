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
use Czubehead\BootstrapForms\Enums\RenderMode;
use Czubehead\BootstrapForms\Inputs\SelectInput;
use Czubehead\BootstrapForms\Inputs\UploadInput;
use Nette;
use Nette\Utils\Html;


/**
 * Converts a Form into Bootstrap 4 HTML output.
 * @property int        $mode
 * @property string     $gridBreakPoint Bootstrap grid breakpoint for side-by-side view. Default is 'sm'
 * @property-read array $config
 * @property-read array $configOverride
 */
class BootstrapRenderer implements Nette\Forms\IFormRenderer
{
	use Nette\SmartObject;

	const defaultLabelColumns = 3;
	const defaultControlColumns = 9;
	/**
	 * @var array of HTML tags
	 */
	public $wrappers = [
		'form' => [
			'container' => NULL,
		],

		'error' => [
			'container'       => NULL,
			'item'            => 'div class="alert alert-danger" role=alert',
			'dismiss'         => 'button class=close type=button data-dismiss=alert aria-label=Close',
			'dismiss_in'      => 'span aria-hidden=true',
			'dismiss_content' => '&times;',
		],

		'group' => [
			'container'   => 'fieldset',
			'label'       => 'legend',
			'description' => 'p',
		],

		'pair' => [
			'container'        => 'div class=form-group',
			'side_container'   => 'div class="form-group row"',
			'inline_container' => 'div class="form-group mr-2 mb-2 mt-2"',
			'.error'           => 'has-danger',
		],

		'control' => [
			'container'      => NULL,
			'side_container' => "div class=col-sm-" . self::defaultControlColumns,

			'description'    => 'small class="form-text text-muted"',
			'errorcontainer' => 'div class=form-control-feedback',
			'erroritem'      => '',

			'.file'   => 'div',
			'.select' => 'div',
		],

		'label' => [
			'container'        => NULL,
			'side_container'   => NULL,
			'inline_container' => 'div class=mr-2',

			'side_class' => 'col-form-label text-md-right col-sm-' . self::defaultLabelColumns,
		],

		'hidden' => [
			'container' => NULL,
		],
	];
	/**
	 * Bootstrap grid breakpoint for side-by-side view
	 * @var string
	 */
	protected $gridBreakPoint = 'sm';
	/** @var BootstrapForm */
	protected $form;
	/** @var int */
	protected $counter;
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
	 * @var bool enable autocomplete on controls
	 */
	private $autocomplete = TRUE;

	/**
	 * BootstrapRenderer constructor.
	 * @param int $mode
	 */
	public function __construct($mode = RenderMode::VerticalMode)
	{
		$this->setMode($mode);
	}

	/**
	 * @return boolean
	 */
	public function getAutocomplete()
	{
		return $this->autocomplete;
	}

	public function setAutocomplete($value)
	{
		$this->autocomplete = $value;
	}

	public function getConfig()
	{
		return [
			Cnf::form  => [],
			Cnf::pair  => [
				Cnf::elementName => 'div',
				Cnf::classSet    => 'form-group',
			],
			Cnf::label => [
				Cnf::elementName => 'label',
			],

			Cnf::input        => [],
			// inputs which are normally inline elements (after bootstrap classes are applied)
			Cnf::inlineInput  => [],
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


			Cnf::inlineClasses => [
				SelectInput::class,
				UploadInput::class,
			],
		];
	}

	public function getConfigOverride()
	{
		return [
			RenderMode::Inline         => [
				Cnf::form => [
					Cnf::classAdd => 'form-inline',
				],
				Cnf::nonLabel => [
					Cnf::elementName => 'div'
				]
			],
			RenderMode::SideBySideMode => [
				Cnf::pair     => [
					Cnf::classAdd => 'row',
				],
				Cnf::label    => [
					Cnf::classAdd => function () {
						return "col-{$this->gridBreakPoint}-{$this->labelColumns}";
					},
				],
				Cnf::nonLabel => [
					Cnf::elementName => 'div',
					Cnf::classSet    => function () {
						return "col-{$this->gridBreakPoint}-{$this->controlColumns}";
					},
				],
			],
			RenderMode::VerticalMode   => [
				Cnf::inlineInput => [
					Cnf::container => [
						Cnf::elementName => 'div',
					],
				],
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
	 * @param string $gridBreakPoint
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
		$this->form = $form;

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
		$this->counter = 0;

		foreach ($this->form->getControls() as $control) {
			$control->setOption('rendered', FALSE);
		}

		$prototype = $this->form->getElementPrototype();
		$prototype = $this->configElem('form', $prototype);

		if ($this->form->isMethod('get')) {
			$el = $prototype;
			$query = parse_url($el->action, PHP_URL_QUERY);
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
		$form = $this->form;
		$translator = $form->getTranslator();
		$outStr = '';


		//region old

		$s = $remains = '';

		$defaultContainer = $this->getWrapper('group container');
		$translator = $this->form->getTranslator();

		foreach ($this->form->getGroups() as $group) {
			if (!$group->getControls() || !$group->getOption('visual')) {
				continue;
			}

			$container = $group->getOption('container', $defaultContainer);
			$container = $container instanceof Html ? clone $container : Html::el($container);

			$id = $group->getOption('id');
			if ($id) {
				$container->id = $id;
			}

			$s .= "\n" . $container->startTag();

			$text = $group->getOption('label');
			if ($text instanceof Html) {
				$s .= $this->getWrapper('group label')->addHtml($text);
			} elseif (is_string($text)) {
				if ($translator !== NULL) {
					$text = $translator->translate($text);
				}
				$s .= "\n" . $this->getWrapper('group label')->setText($text) . "\n";
			}

			$text = $group->getOption('description');
			if ($text instanceof Html) {
				$s .= $text;
			} elseif (is_string($text)) {
				if ($translator !== NULL) {
					$text = $translator->translate($text);
				}
				$s .= $this->getWrapper('group description')->setText($text) . "\n";
			}

			$s .= $this->renderControls($group);

			$remains = $container->endTag() . "\n" . $remains;
			if (!$group->getOption('embedNext')) {
				$s .= $remains;
				$remains = '';
			}
		}

		$s .= $remains . $this->renderControls($this->form);

		$container = $this->getWrapper('form container');
		$container->setHtml($s);

		return $container->render(0);
		//endregion
	}

	/**
	 * Renders 'control' part of visual row of controls.
	 * @param \Nette\Forms\IControl $control
	 * @return string
	 */
	public function renderControl(Nette\Forms\IControl $control)
	{
		$controlHtml = $control->getControl();
		$control->setOption('rendered', TRUE);
		$controlHtml = $this->configElem(Cnf::input, $controlHtml);
		if ($this->form->showValidation || $control->hasErrors()) {
			if ($control->hasErrors()) {
				$controlHtml = $this->configElem(Cnf::inputInvalid, $controlHtml);
			} else {
				$controlHtml = $this->configElem(Cnf::inputValid, $controlHtml);
			}
		}

		foreach ($this->fetchConfig(Cnf::inlineClasses) as $inlineClass) {
			if (is_a($control, $inlineClass, TRUE)) {
				$controlHtml = $this->configElem(Cnf::inlineInput, $controlHtml);
				break;
			}
		}

		return $controlHtml;

		// TODO propagate autocomplete to input and textare on a different level


		// old
		// TODO remove

		if ($this->mode == RenderMode::SideBySideMode) {
			$body = $this->getWrapper('control side_container');
		} else {
			$body = $this->getWrapper('control container');
		}

		$description = $control->getOption('description');
		if ($description instanceof Html) {
			$description = ' ' . $description;
		} elseif (is_string($description)) {
			if ($control instanceof Nette\Forms\Controls\BaseControl) {
				$description = $control->translate($description);
			}
			$description = ' ' . $this->getWrapper('control description')->setText($description);
		} else {
			$description = '';
		}

		$control->setOption('rendered', TRUE);
		$el = $control->getControl();
		if ($el instanceof Html && in_array($el->getName(), ['input', 'textarea'])) {
			$el->setAttribute('autocomplete', $this->autocomplete ? "on" : "off");
		}

		if (empty($body->render()) && $this->mode == RenderMode::VerticalMode) {
			// some would be inline otherwise
			if ($control instanceof UploadInput) {
				$body = $this->getWrapper('control .file');
			} elseif ($control instanceof SelectInput) {
				$body = $this->getWrapper('control .select');
			}
		}

		return $body->setHtml($el . $description . $this->renderErrors($control));
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

		$hidden = [];
		foreach ($parent->getControls() as $control) {
			if ($control->getOption('type') == 'hidden') {
				$hidden[] = $this->renderControl($control);
			} else {
				$html->addHtml($this->renderPair($control));
			}
		}

		foreach ($hidden as $item) {
			$html->addHtml($item);
		}

		return $html;

		//old
		// TODO remove
		if (!($parent instanceof Nette\Forms\Container || $parent instanceof Nette\Forms\ControlGroup)) {
			throw new Nette\InvalidArgumentException('Argument must be Nette\Forms\Container or Nette\Forms\ControlGroup instance.');
		}

		$container = Html::el();

		$buttons = NULL;
		foreach ($parent->getControls() as $control) {
			if ($control->getOption('rendered') || $control->getOption('type') === 'hidden' ||
				$control->getForm(FALSE) !== $this->form
			) {
				// skip
			}
			//            elseif ($control->getOption('type') === 'button')
			//            {
			//                $buttons[] = $control;
			//            }
			else {
				if ($buttons) {
					$container->addHtml($this->renderPairMulti($buttons));
					$buttons = NULL;
				}
				$container->addHtml($this->renderPair($control));
			}
		}

		if ($buttons) {
			$container->addHtml($this->renderPairMulti($buttons));
		}

		$s = '';
		if (count($container)) {
			$s .= "\n" . $container . "\n";
		}

		return $s;
	}

	/**
	 * Renders form end.
	 * @return string
	 */
	public function renderEnd()
	{
		$s = '';
		foreach ($this->form->getControls() as $control) {
			if ($control->getOption('type') === 'hidden' && !$control->getOption('rendered')) {
				$s .= $control->getControl();
			}
		}
		if (iterator_count($this->form->getComponents(TRUE, Nette\Forms\Controls\TextInput::class)) < 2) {
			$s .= '<!--[if IE]><input type=IEbug disabled style="display:none"><![endif]-->';
		}
		if ($s) {
			$s = $this->getWrapper('hidden container')->setHtml($s) . "\n";
		}

		return $s . $this->form->getElementPrototype()->endTag() . "\n";
	}

	/**
	 * Renders validation errors (per form or per control).
	 * @param \Nette\Forms\IControl $control
	 * @param bool                  $own
	 * @return string
	 */
	public function renderErrors(Nette\Forms\IControl $control = NULL, $own = TRUE)
	{
		// TODO remove

		$errors = $control
			? $control->getErrors()
			: ($own ? $this->form->getOwnErrors() : $this->form->getErrors());
		if (!$errors) {
			return "";
		}
		$container = $this->getWrapper($control ? 'control errorcontainer' : 'error container');
		$item = $this->getWrapper($control ? 'control erroritem' : 'error item');

		foreach ($errors as $error) {
			$item = clone $item;
			//            $closeBtn = $this->getWrapper('error dismiss');
			//            $closeIn = $this->getWrapper('error dismiss_in')
			//                            ->setHtml($this->getValue('error dismiss_content'));
			//            $closeBtn->setHtml($closeIn);
			//            $item->addHtml($closeBtn);

			if ($error instanceof Html) {
				$item->addHtml($error);
			} else {
				$item->addText($error);
			}
			$container->addHtml($item);
		}

		return "\n" . $container->render($control ? 1 : 0);
	}

	/**
	 * Renders 'label' part of visual row of controls.
	 * @param \Nette\Forms\IControl $control
	 * @return Html
	 */
	public function renderLabel(Nette\Forms\IControl $control)
	{
		$controlLabel = $control->getLabel();
		if ($controlLabel instanceof Html && $controlLabel->getName() == 'label') {
			// the control has already provided us with the element, no need to create our own
			$controlLabel = $this->configElem(Cnf::label, $controlLabel);
			// just configure it to suit our needs

			$labelHtml = $controlLabel;
		} else {
			// the control doesn't give us <label>, se we'll create our own
			$labelHtml = $this->getElem(Cnf::label);
			if ($controlLabel) {
				$labelHtml->setHtml($controlLabel);
			}
		}

		return $labelHtml;

		// old

		// TODO remove
		if ($this->mode == RenderMode::SideBySideMode) {
			$label = $this->getWrapper('label side_container');
		} elseif ($this->mode == RenderMode::VerticalMode) {
			$label = $this->getWrapper('label container');
		} else {
			$label = $this->getWrapper('label inline_container');
		}

		$controlLabel = $control->getLabel();
		if ($controlLabel instanceof Html && $this->mode == RenderMode::SideBySideMode) {
			$controlLabel->class[] = $this->getValue('label side_class');
		}
		$label->setHtml($controlLabel);

		if (empty($label->render()) && $this->renderMode == RenderMode::SideBySideMode) {
			// In side-by-side mode, label must not be empty. Use a placeholder instead.
			$label = Html::el('div', [
				'class' => $this->getValue('label side_class'),
			]);
		}

		return $label;
	}

	/**
	 * Renders single visual row.
	 * @param \Nette\Forms\IControl $control
	 * @return string
	 */
	public function renderPair(Nette\Forms\IControl $control)
	{
		$pairHtml = $this->configElem(Cnf::pair);
		$pairHtml->id = $control->getOption('id');

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
		// old

		// TODO remove
		if ($this->mode == RenderMode::SideBySideMode) {
			$pair = $this->getWrapper('pair side_container');
		} elseif ($this->mode == RenderMode::VerticalMode) {
			$pair = $this->getWrapper('pair container');
		} else {
			$pair = $this->getWrapper('pair inline_container');
		}

		$pair->addHtml($this->renderLabel($control));
		$pair->addHtml($this->renderControl($control));
		$pair->class($control->hasErrors() ? $this->getValue('pair .error') : NULL, TRUE);
		$pair->class($control->getOption('class'), TRUE);
		$pair->id = $control->getOption('id');

		return $pair->render(0);
	}

	/**
	 * Renders single visual row of multiple controls.
	 * @param  Nette\Forms\IControl[]
	 * @return string
	 */
	public function renderPairMulti(array $controls)
	{
		// TODO remove

		$s = [];
		foreach ($controls as $control) {
			if (!$control instanceof Nette\Forms\IControl) {
				throw new Nette\InvalidArgumentException('Argument must be array of Nette\Forms\IControl instances.');
			}
			$description = $control->getOption('description');
			if ($description instanceof Html) {
				$description = ' ' . $control->getOption('description');
			} elseif (is_string($description)) {
				if ($control instanceof Nette\Forms\Controls\BaseControl) {
					$description = $control->translate($description);
				}
				$description = ' ' . $this->getWrapper('control description')->setText($description);
			} else {
				$description = '';
			}

			$control->setOption('rendered', TRUE);
			$el = $control->getControl();
			if ($el instanceof Html && $el->getName() === 'input') {
				$el->class($this->getValue("control .$el->type"), TRUE);
			}
			$s[] = $el . $description;
		}
		$pair = $this->getWrapper('pair container');
		$pair->addHtml($this->renderLabel($control));
		$pair->addHtml($this->getWrapper('control container')->setHtml(implode(' ', $s)));

		return $pair->render(0);
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

		$this->wrappers['control']['side_container'] = "div class=col-sm-$control";
		$this->wrappers['label']['side_container'] = "div class=col-sm-$label";
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
	 * Turns configuration or and existing element and configures it appropriately
	 * @param $config array|string top-level config key
	 * @param $el     Html|null elem to config.
	 * @return Html|null
	 */
	protected function configElem($config, $el = NULL)
	{
		if (is_scalar($config)) {
			$config = $this->fetchConfig($config);
		}

		// first define which element we want to work with
		if (isset($config[ Cnf::elementName ])) {
			$name = $config[ Cnf::elementName ];
			if (is_array($name)) {
				// these are only added instead of merging, so take the last one
				$name = $name[ count($name) - 1 ];
			}
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
				// value may be a closure. In that case, use the return value
				if (is_callable($value)) {
					$value = $value();
				}

				if ($key == Cnf::classSet) {
					$el->class = $value;
				} elseif ($key == Cnf::classAdd) {
					if (is_array($value)) {
						$origClass = is_array($el->class) ? $el->class : explode(' ', $el->class);
						$el->class = array_merge($origClass, $value);
					} elseif (is_scalar($value)) {
						if (!is_array($el->class) && isset($el->class)) {
							// class can also be a simple string
							$class = explode(' ', $el->class);
							$class[] = $value;
							$el->class = $class;
						} else {
							$el->class[] = $value;
						}
					}
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
			$config = array_merge_recursive($config, $override);
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
		$el = $this->configElem($key,Html::el());

		foreach ($additionalKeys as $additionalKey) {
			$config = $this->fetchConfig($additionalKey);
			$el = $this->configElem($config, $el);
		}

		return $el;
	}

	/**
	 * @param  string
	 * @return string
	 */
	protected
	function getValue($name)
	{
		$name = explode(' ', $name);
		$data = &$this->wrappers[ $name[0] ][ $name[1] ];

		return $data;
	}

	/**
	 * @param  string
	 * @return Html
	 */
	protected
	function getWrapper($name)
	{
		$data = $this->getValue($name);

		return $data instanceof Html ? clone $data : Html::el($data);
	}

	/**
	 * Renders control description (help text)
	 * @param Nette\Forms\IControl $control
	 * @return Html|null
	 */
	protected function renderDescription(Nette\Forms\IControl $control)
	{
		$description = $control->getOption('description');
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

		if ($control instanceof Nette\Forms\Controls\BaseControl) {
			// specific control

			if ($control->hasErrors()) {
				// control is invalid, mark it that way
				$isValid = FALSE;
				$showFeedback = TRUE;
				$messages = $control->getErrors();
			} elseif ($this->form->showValidation) {
				$isValid = TRUE;
				// control is valid and we want to explicitly show that it's valid
				$message = $control->getOption(Cnf::feedbackValid);
				if ($message) {
					$messages = [$message];
					$showFeedback = TRUE;
				} else {
					$showFeedback = FALSE;
				}
			}
		} elseif ($control === NULL) {
			// whole form
			$form = $this->form;

			if ($form->hasErrors()) {
				$isValid = FALSE;
				$showFeedback = TRUE;
				$messages = $form->getErrors();
			} else {
				$showFeedback = FALSE;
				$isValid = TRUE;
				// this doesn't make sense, form is sent if it's valid
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
	}
}
