<?php
/**
 * Created by Petr Čech (czubehead).
 * Timestamp: 20.5.18 17:12
 */

namespace Czubehead\BootstrapForms\Grid;


use Czubehead\BootstrapForms\Traits\BootstrapContainerTrait;
use LogicException;
use Nette\ComponentModel\IComponent;
use Nette\SmartObject;
use Nette\Utils\Html;


/**
 * Class BootstrapCell.
 * Represents a row-column pair = table cell in Bootstrap grid system. This is the part with col-*-* class.
 * Only one component can be present.
 * @package Czubehead\BootstrapForms\Grid
 * @property-read int  $numOfColumns     Number of Bootstrap columns to occupy
 * @property-read bool $occupied         if a control is already set and thus no other can be added.
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
	 * If is already hosting a control
	 * @var bool
	 */
	private $isOccupied = FALSE;
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
	 * @return bool
	 */
	public function isOccupied()
	{
		return $this->isOccupied;
	}

	/**
	 * Delegate to underlying component.
	 * @param IComponent $component
	 * @param            $name
	 * @param null       $insertBefore
	 */
	protected function addComponent(IComponent $component, $name, $insertBefore = NULL)
	{
		if ($this->isOccupied) {
			throw new LogicException('a control for this cell has already been set, you cannot add another one');
		}

		/** @noinspection PhpInternalEntityUsedInspection */
		$this->row->addComponent($component, $name, $insertBefore);
		$this->isOccupied = TRUE;
	}
}