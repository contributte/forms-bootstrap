<?php

/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://gitlab.com/czubehead/bootstrap-4-forms
 *
 * based on the original FormRenderer by David Grudl
 */

namespace Czubehead\BootstrapForms;

use Czubehead\BootstrapForms\Inputs\SelectInput;
use Czubehead\BootstrapForms\Inputs\UploadInput;
use Nette;
use Nette\Utils\Html;

/**
 * Converts a Form into Bootstrap 4 HTML output.
 * @property int $mode
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
			'container' => null,
		],

		'error' => [
			'container'       => null,
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
			'container'      => null,
			'side_container' => "div class=col-sm-" . self::defaultControlColumns,

			'description'    => 'small class="form-text text-muted"',
			'errorcontainer' => 'div class=form-control-feedback',
			'erroritem'      => '',

			'.file'   => 'div',
			'.select' => 'div',
		],

		'label' => [
			'container'        => null,
			'side_container'   => null,
			'inline_container' => 'div class=mr-2',

			'side_class' => 'col-form-label text-md-right col-sm-' . self::defaultLabelColumns,
		],

		'hidden' => [
			'container' => null,
		],
	];

	/** @var Nette\Forms\Form */
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
	private $autocomplete = true;

	/**
	 * BootstrapRenderer constructor.
	 *
	 * @param int $mode
	 */
	public function __construct($mode = RenderMode::VerticalMode)
	{
		$this->setMode($mode);
	}

	/**
	 * Sets render mode
	 *
	 * @param int $renderMode RenderMode
	 *
	 * @see RenderMode
	 */
	public function setMode($renderMode)
	{
		$this->renderMode = $renderMode;
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
	 *
	 * @param \Nette\Forms\Form $form
	 *
	 * @param null              $mode
	 *
	 * @return string
	 */
	public function render(Nette\Forms\Form $form, $mode = null)
	{
		if ($this->form !== $form)
		{
			$this->form = $form;
		}

		$s = '';
		if (!$mode || $mode === 'begin')
		{
			$s .= $this->renderBegin();
		}
		if (!$mode || strtolower($mode) === 'ownerrors')
		{
			$s .= $this->renderErrors();
		}
		elseif ($mode === 'errors')
		{
			$s .= $this->renderErrors(null, false);
		}
		if (!$mode || $mode === 'body')
		{
			$s .= $this->renderBody();
		}
		if (!$mode || $mode === 'end')
		{
			$s .= $this->renderEnd();
		}

		return $s;
	}

	/**
	 * Renders form begin.
	 * @return string
	 */
	public function renderBegin()
	{
		$this->counter = 0;

		foreach ($this->form->getControls() as $control)
		{
			$control->setOption('rendered', false);
		}

		$prototype = clone $this->form->getElementPrototype();
		if ($this->mode == RenderMode::Inline)
		{
			$prototype->class[] = "form-inline";
		}
		if ($this->form instanceof BootstrapForm && $this->form->ajax)
		{
			$prototype->class[] = 'ajax';
		}

		if ($this->form->isMethod('get'))
		{
			$el = $prototype;
			$query = parse_url($el->action, PHP_URL_QUERY);
			$el->action = str_replace("?$query", '', $el->action);
			$s = '';
			foreach (preg_split('#[;&]#', $query, null, PREG_SPLIT_NO_EMPTY) as $param)
			{
				$parts = explode('=', $param, 2);
				$name = urldecode($parts[0]);
				if (!isset($this->form[ $name ]))
				{
					$s .= Html::el('input', ['type' => 'hidden', 'name' => $name, 'value' => urldecode($parts[1])]);
				}
			}

			return $el->startTag() . ($s ? "\n\t" . $this->getWrapper('hidden container')->setHtml($s) : '');
		}
		else
		{
			return $prototype->startTag();
		}
	}

	/**
	 * @param  string
	 *
	 * @return Html
	 */
	protected function getWrapper($name)
	{
		$data = $this->getValue($name);

		return $data instanceof Html ? clone $data : Html::el($data);
	}

	/**
	 * @param  string
	 *
	 * @return string
	 */
	protected function getValue($name)
	{
		$name = explode(' ', $name);
		$data = &$this->wrappers[ $name[0] ][ $name[1] ];

		return $data;
	}

	/**
	 * Renders validation errors (per form or per control).
	 *
	 * @param \Nette\Forms\IControl $control
	 * @param bool                  $own
	 *
	 * @return string
	 */
	public function renderErrors(Nette\Forms\IControl $control = null, $own = true)
	{
		$errors = $control
			? $control->getErrors()
			: ($own ? $this->form->getOwnErrors() : $this->form->getErrors());
		if (!$errors)
		{
			return "";
		}
		$container = $this->getWrapper($control ? 'control errorcontainer' : 'error container');
		$item = $this->getWrapper($control ? 'control erroritem' : 'error item');

		foreach ($errors as $error)
		{
			$item = clone $item;
			//            $closeBtn = $this->getWrapper('error dismiss');
			//            $closeIn = $this->getWrapper('error dismiss_in')
			//                            ->setHtml($this->getValue('error dismiss_content'));
			//            $closeBtn->setHtml($closeIn);
			//            $item->addHtml($closeBtn);

			if ($error instanceof Html)
			{
				$item->addHtml($error);
			}
			else
			{
				$item->addText($error);
			}
			$container->addHtml($item);
		}

		return "\n" . $container->render($control ? 1 : 0);
	}

	/**
	 * Renders form body.
	 * @return string
	 */
	public function renderBody()
	{
		$s = $remains = '';

		$defaultContainer = $this->getWrapper('group container');
		$translator = $this->form->getTranslator();

		foreach ($this->form->getGroups() as $group)
		{
			if (!$group->getControls() || !$group->getOption('visual'))
			{
				continue;
			}

			$container = $group->getOption('container', $defaultContainer);
			$container = $container instanceof Html ? clone $container : Html::el($container);

			$id = $group->getOption('id');
			if ($id)
			{
				$container->id = $id;
			}

			$s .= "\n" . $container->startTag();

			$text = $group->getOption('label');
			if ($text instanceof Html)
			{
				$s .= $this->getWrapper('group label')->addHtml($text);
			}
			elseif (is_string($text))
			{
				if ($translator !== null)
				{
					$text = $translator->translate($text);
				}
				$s .= "\n" . $this->getWrapper('group label')->setText($text) . "\n";
			}

			$text = $group->getOption('description');
			if ($text instanceof Html)
			{
				$s .= $text;
			}
			elseif (is_string($text))
			{
				if ($translator !== null)
				{
					$text = $translator->translate($text);
				}
				$s .= $this->getWrapper('group description')->setText($text) . "\n";
			}

			$s .= $this->renderControls($group);

			$remains = $container->endTag() . "\n" . $remains;
			if (!$group->getOption('embedNext'))
			{
				$s .= $remains;
				$remains = '';
			}
		}

		$s .= $remains . $this->renderControls($this->form);

		$container = $this->getWrapper('form container');
		$container->setHtml($s);

		return $container->render(0);
	}

	/**
	 * Renders group of controls.
	 *
	 * @param  Nette\Forms\Container|Nette\Forms\ControlGroup
	 *
	 * @return string
	 */
	public function renderControls($parent)
	{
		if (!($parent instanceof Nette\Forms\Container || $parent instanceof Nette\Forms\ControlGroup))
		{
			throw new Nette\InvalidArgumentException('Argument must be Nette\Forms\Container or Nette\Forms\ControlGroup instance.');
		}

		$container = Html::el();

		$buttons = null;
		foreach ($parent->getControls() as $control)
		{
			if ($control->getOption('rendered') || $control->getOption('type') === 'hidden' ||
				$control->getForm(false) !== $this->form
			)
			{
				// skip
			}
			//            elseif ($control->getOption('type') === 'button')
			//            {
			//                $buttons[] = $control;
			//            }
			else
			{
				if ($buttons)
				{
					$container->addHtml($this->renderPairMulti($buttons));
					$buttons = null;
				}
				$container->addHtml($this->renderPair($control));
			}
		}

		if ($buttons)
		{
			$container->addHtml($this->renderPairMulti($buttons));
		}

		$s = '';
		if (count($container))
		{
			$s .= "\n" . $container . "\n";
		}

		return $s;
	}

	/**
	 * Renders single visual row of multiple controls.
	 *
	 * @param  Nette\Forms\IControl[]
	 *
	 * @return string
	 */
	public function renderPairMulti(array $controls)
	{
		$s = [];
		foreach ($controls as $control)
		{
			if (!$control instanceof Nette\Forms\IControl)
			{
				throw new Nette\InvalidArgumentException('Argument must be array of Nette\Forms\IControl instances.');
			}
			$description = $control->getOption('description');
			if ($description instanceof Html)
			{
				$description = ' ' . $control->getOption('description');
			}
			elseif (is_string($description))
			{
				if ($control instanceof Nette\Forms\Controls\BaseControl)
				{
					$description = $control->translate($description);
				}
				$description = ' ' . $this->getWrapper('control description')->setText($description);
			}
			else
			{
				$description = '';
			}

			$control->setOption('rendered', true);
			$el = $control->getControl();
			if ($el instanceof Html && $el->getName() === 'input')
			{
				$el->class($this->getValue("control .$el->type"), true);
			}
			$s[] = $el . $description;
		}
		$pair = $this->getWrapper('pair container');
		$pair->addHtml($this->renderLabel($control));
		$pair->addHtml($this->getWrapper('control container')->setHtml(implode(' ', $s)));

		return $pair->render(0);
	}

	/**
	 * Renders 'label' part of visual row of controls.
	 *
	 * @param \Nette\Forms\IControl $control
	 *
	 * @return string
	 */
	public function renderLabel(Nette\Forms\IControl $control)
	{
		if ($this->mode == RenderMode::SideBySideMode)
		{
			$label = $this->getWrapper('label side_container');
		}
		elseif ($this->mode == RenderMode::VerticalMode)
		{
			$label = $this->getWrapper('label container');
		}
		else
		{
			$label = $this->getWrapper('label inline_container');
		}

		$controlLabel = $control->getLabel();
		if ($controlLabel instanceof Html && $this->mode == RenderMode::SideBySideMode)
		{
			$controlLabel->class[] = $this->getValue('label side_class');
		}
		$label->setHtml($controlLabel);

		if (empty($label->render()) && $this->renderMode == RenderMode::SideBySideMode)
		{
			// In side-by-side mode, label must not be empty. Use a placeholder instead.
			$label = Html::el('div', [
				'class' => $this->getValue('label side_class'),
			]);
		}

		return $label;
	}

	/**
	 * Renders single visual row.
	 *
	 * @param \Nette\Forms\IControl $control
	 *
	 * @return string
	 */
	public function renderPair(Nette\Forms\IControl $control)
	{
		if ($this->mode == RenderMode::SideBySideMode)
		{
			$pair = $this->getWrapper('pair side_container');
		}
		elseif ($this->mode == RenderMode::VerticalMode)
		{
			$pair = $this->getWrapper('pair container');
		}
		else
		{
			$pair = $this->getWrapper('pair inline_container');
		}

		$pair->addHtml($this->renderLabel($control));
		$pair->addHtml($this->renderControl($control));
		$pair->class($control->hasErrors() ? $this->getValue('pair .error') : null, true);
		$pair->class($control->getOption('class'), true);
		$pair->id = $control->getOption('id');

		return $pair->render(0);
	}

	/**
	 * Renders 'control' part of visual row of controls.
	 *
	 * @param \Nette\Forms\IControl $control
	 *
	 * @return string
	 */
	public function renderControl(Nette\Forms\IControl $control)
	{
		if ($this->mode == RenderMode::SideBySideMode)
		{
			$body = $this->getWrapper('control side_container');
		}
		else
		{
			$body = $this->getWrapper('control container');
		}

		$description = $control->getOption('description');
		if ($description instanceof Html)
		{
			$description = ' ' . $description;
		}
		elseif (is_string($description))
		{
			if ($control instanceof Nette\Forms\Controls\BaseControl)
			{
				$description = $control->translate($description);
			}
			$description = ' ' . $this->getWrapper('control description')->setText($description);
		}
		else
		{
			$description = '';
		}

		$control->setOption('rendered', true);
		$el = $control->getControl();
		if ($el instanceof Html && in_array($el->getName(), ['input', 'textarea']))
		{
			$el->setAttribute('autocomplete', $this->autocomplete ? "on" : "off");
		}

		if (empty($body->render()) && $this->mode == RenderMode::VerticalMode)
		{
			// some would be inline otherwise
			if ($control instanceof UploadInput)
			{
				$body = $this->getWrapper('control .file');
			}
			elseif ($control instanceof SelectInput)
			{
				$body = $this->getWrapper('control .select');
			}
		}

		return $body->setHtml($el . $description . $this->renderErrors($control));
	}

	/**
	 * Renders form end.
	 * @return string
	 */
	public function renderEnd()
	{
		$s = '';
		foreach ($this->form->getControls() as $control)
		{
			if ($control->getOption('type') === 'hidden' && !$control->getOption('rendered'))
			{
				$s .= $control->getControl();
			}
		}
		if (iterator_count($this->form->getComponents(true, Nette\Forms\Controls\TextInput::class)) < 2)
		{
			$s .= '<!--[if IE]><input type=IEbug disabled style="display:none"><![endif]-->';
		}
		if ($s)
		{
			$s = $this->getWrapper('hidden container')->setHtml($s) . "\n";
		}

		return $s . $this->form->getElementPrototype()->endTag() . "\n";
	}

	/**
	 * Set how many of Bootstrap rows shall the label and control occupy
	 *
	 * @param int      $label
	 * @param int|null $control
	 */
	public function setColumns($label, $control = null)
	{
		if ($control === null)
		{
			$control = 12 - $label;
		}

		$this->labelColumns = $label;
		$this->controlColumns = $control;

		$this->wrappers['control']['side_container'] = "div class=col-sm-$control";
		$this->wrappers['label']['side_container'] = "div class=col-sm-$label";
	}
}
