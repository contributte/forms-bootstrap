<?php

namespace Contributte\FormsBootstrap;


use Contributte\FormsBootstrap\Traits\AddRowTrait;
use Contributte\FormsBootstrap\Traits\BootstrapContainerTrait;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IContainer;
use Nette\Forms\IFormRenderer;
use Nette\InvalidArgumentException;
use Nette\Utils\Html;


/**
 * Class BootstrapForm
 * Form rendered using Bootstrap 4
 * @package Contributte\FormsBootstrap
 * @property bool $ajax
 * @property int  $renderMode
 * @property bool $showValidation     If valid fields should explicitly be green if valid
 * @property bool $autoShowValidation If true, valid inputs will be explicitly green on unsuccessful submit
 */
class BootstrapForm extends Form
{
	use BootstrapContainerTrait;
	use AddRowTrait;

	/**
	 * @var string Class to be added if this is ajax. Defaults to 'ajax'
	 */
	public $ajaxClass = 'ajax';
	/**
	 * @var Html
	 */
	protected $elementPrototype;
	/**
	 * @var bool
	 */
	private $isAjax = TRUE;
	/**
	 * @var bool
	 */
	private $showValidation = FALSE;
	/**
	 * @var bool
	 */
	private $autoShowValidation = TRUE;

	/**
	 * BootstrapForm constructor.
	 * @param int|IContainer|null $container
	 */
	public function __construct($container = NULL)
	{
		parent::__construct($container);
		$this->setRenderer(new BootstrapRenderer);

		$prototype = Html::el('form', [
			'action' => '',
			'method' => self::POST,
			'class'  => [],
		]);
		$this->elementPrototype = $prototype;

		/**
		 * @param BootstrapForm $form
		 */
		$this->onError[] = function ($form) {
			$form->showValidation = $this->autoShowValidation;
		};
	}

	public function getElementPrototype()
	{
		return $this->elementPrototype;
	}

	/**
	 * @return \Contributte\FormsBootstrap\BootstrapRenderer|\Nette\Forms\IFormRenderer
	 */
	public function getRenderer()
	{
		return parent::getRenderer();
	}

	/**
	 * @param IFormRenderer $renderer
	 * @return static
	 */
	public function setRenderer(IFormRenderer $renderer = NULL)
	{
		if (!$renderer instanceof BootstrapRenderer) {
			throw new InvalidArgumentException('Must be a BootstrapRenderer');
		}
		parent::setRenderer($renderer);

		return $this;
	}

	/**
	 * @return int
	 */
	public function getRenderMode()
	{
		return $this->getRenderer()->getMode();
	}

	/**
	 * @return bool if form is ajax. True by default.
	 */
	public function isAjax()
	{
		return $this->isAjax;
	}

	/**
	 * @return bool
	 */
	public function isAutoShowValidation()
	{
		return $this->autoShowValidation;
	}

	/**
	 * @param bool $autoShowValidation
	 * @return BootstrapForm
	 */
	public function setAutoShowValidation($autoShowValidation)
	{
		$this->autoShowValidation = $autoShowValidation;

		return $this;
	}

	/**
	 * If valid fields should explicitly be green
	 * @return bool
	 */
	public function isShowValidation()
	{
		return $this->showValidation;
	}

	/**
	 * If valid fields should explicitly be green
	 * @param bool $showValidation
	 * @return static
	 */
	public function setShowValidation($showValidation)
	{
		$this->showValidation = $showValidation;

		return $this;
	}

	/**
	 * @param bool $isAjax
	 * @return static
	 */
	public function setAjax($isAjax = TRUE)
	{
		$this->isAjax = $isAjax;

		BootstrapUtils::standardizeClass($this->getElementPrototype());
		$prototypeClass = $this->getElementPrototype()->class;

		$present = in_array($this->ajaxClass, $prototypeClass);
		if ($present && !$isAjax) {
			// remove the class
			$prototypeClass = array_diff($prototypeClass, [$this->ajaxClass]);
		} elseif (!$present && $isAjax) {
			// add class
			$prototypeClass[] = $this->ajaxClass;
		}
		$this->getElementPrototype()->class = $prototypeClass;

		return $this;
	}

	/**
	 * @param int $renderMode
	 * @return static
	 */
	public function setRenderMode($renderMode)
	{
		$this->getRenderer()->setMode($renderMode);

		return $this;
	}
}
