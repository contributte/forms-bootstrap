<?php
/**
 * Created by PhpStorm
 * Author: czubehead (http://petrcech.eu)
 * Date: 19.11.16
 * Time: 14:37
 */

namespace Czubehead\BootstrapForms;


use Czubehead\BootstrapForms\Traits\BootstrapContainerTrait;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IContainer;
use Nette\Forms\IFormRenderer;
use Nette\InvalidArgumentException;


/**
 * Class BootstrapForm
 * Form rendered using Bootstrap 4
 * @package Czubehead\BootstrapForms
 * @property bool $ajax
 * @property int  $renderMode
 */
class BootstrapForm extends Form
{
	use BootstrapContainerTrait;

	/**
	 * @var bool
	 */
	protected $isAjax = TRUE;

	/**
	 * BootstrapForm constructor.
	 * @param int|IContainer|null $container
	 */
	public function __construct($container = NULL)
	{
		parent::__construct($container);
		$this->setRenderer(new BootstrapRenderer);
	}

	/**
	 * @return int
	 */
	public function getRenderMode()
	{
		return $this->getRenderer()->getMode();
	}

	/**
	 * @return \Czubehead\BootstrapForms\BootstrapRenderer|\Nette\Forms\IFormRenderer
	 */
	public function getRenderer()
	{
		return parent::getRenderer();
	}

	/**
	 * @param IFormRenderer $renderer
	 * @return void
	 */
	public function setRenderer(IFormRenderer $renderer = NULL)
	{
		if (!$renderer instanceof BootstrapRenderer) {
			throw new InvalidArgumentException('Must be a BootstrapRenderer');
		}
		parent::setRenderer($renderer);
	}

	/**
	 * @return bool if form is ajax. True by default.
	 */
	public function isAjax()
	{
		return $this->isAjax;
	}

	/**
	 * @param bool $isAjax
	 * @return BootstrapForm
	 */
	public function setAjax($isAjax = TRUE)
	{
		$this->isAjax = $isAjax;

		return $this;
	}

	/**
	 * @param int $renderMode
	 */
	public function setRenderMode($renderMode)
	{
		$this->getRenderer()->setMode($renderMode);
	}
}