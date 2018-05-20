<?php
/**
 * Created by Petr Čech (czubehead).
 * Timestamp: 20.5.18 17:12
 */

namespace Czubehead\BootstrapForms\Grid;


use Czubehead\BootstrapForms\BootstrapRenderer;
use Czubehead\BootstrapForms\BootstrapUtils;
use Czubehead\BootstrapForms\Traits\BootstrapContainerTrait;
use LogicException;
use Nette\ComponentModel\IComponent;
use Nette\Forms\IControl;
use Nette\SmartObject;
use Nette\Utils\Html;


/**
 * Class BootstrapCell.
 * Represents a row-column pair = table cell in Bootstrap grid system. This is the part with col-*-* class.
 * Only one component can be present.
 * @package Czubehead\BootstrapForms\Grid
 * @property-read int  $numOfColumns     Number of Bootstrap columns to occupy
 * @property-read IControl $childControl|null     Nested child control if any
 * @property-read Html $elementPrototype the Html div that will be rendered. You may define additional
 *                properties.
 */
class BootstrapCell
{
	use SmartObject;
	use BootstrapContainerTrait;

	/**
	 * @var int
	 */
	private $numOfColumns;
	/**
	 * @var IControl|null
	 */
	private $childControl;
	/**
	 * @var BootstrapRow
	 */
	private $row;
	/**
	 * @var Html
	 */
	private $elementPrototype;

	/**
	 * BootstrapRow constructor.
	 * @param BootstrapRow $row          Row this is a child of
	 * @param int          $numOfColumns Number of Bootstrap columns to occupy
	 */
	public function __construct(BootstrapRow $row, $numOfColumns)
	{
		$this->numOfColumns = $numOfColumns;
		$this->row = $row;

		$this->elementPrototype = Html::el('div');
	}

	/**
	 * Gets the prototype of this cell so you can define additional attributes. Col-* class is added during
	 * rendering and is not present, so don't add it...
	 * @return Html
	 */
	public function getElementPrototype()
	{
		return $this->elementPrototype;
	}

	/**
	 * @return int
	 */
	public function getNumOfColumns()
	{
		return $this->numOfColumns;
	}

	/**
	 * Renders the cell into Html object
	 * @return Html
	 */
	public function render()
	{
		$element = $this->elementPrototype;

		BootstrapUtils::standardizeClass($element);
		$element->class[] = 'col-' . $this->row->gridBreakPoint . '-' . $this->numOfColumns;

		if ($this->childControl) {
			/** @noinspection PhpUndefinedFieldInspection */
			/** @var BootstrapRenderer $renderer */
			$renderer = $this->childControl->form->renderer;

			$pairHtml = $renderer->renderPair($this->childControl);
			$element->addHtml($pairHtml);
		}

		return $element;
	}

	/**
	 * Delegate to underlying component.
	 * @param IComponent $component
	 * @param            $name
	 * @param null       $insertBefore
	 */
	protected function addComponent(IComponent $component, $name, $insertBefore = NULL)
	{
		if ($this->childControl) {
			throw new LogicException('child control for this cell has already been set, you cannot add another one');
		}

		/** @noinspection PhpInternalEntityUsedInspection */
		$this->row->addComponent($component, $name, $insertBefore);
		$this->childControl = $component;
	}
}