<?php
/**
 * Created by Petr Čech (czubehead).
 * Timestamp: 20.5.18 17:01
 */

namespace Czubehead\BootstrapForms\Grid;

use Nette\ComponentModel\IComponent;
use Nette\Forms\Container;
use Nette\InvalidArgumentException;
use Nette\SmartObject;
use Nette\Utils\Html;


/**
 * Class BootstrapRow.
 * Represents a row in Bootstrap grid system.
 * @package Czubehead\BootstrapForms\Grid
 * @property string               $gridBreakpoint   Bootstrap breakpoint - usually xs, sm, md, lg. md by
 *           default.
 * @property-read string[]        $ownedNames       list of names of components which were added to this row
 * @property-read BootstrapCell[] $cells            cells in this row
 * @property-read Html            $elementPrototype the Html div that will be rendered. You may define
 *                additional properties.
 */
class BootstrapRow
{
	use SmartObject;

	/**
	 * Number of columns in Bootstrap grid. Default is 12, but it can be customized.
	 * @var int
	 */
	public $numOfColumns = 12;
	/**
	 * Number of columns used by added cells.
	 * @var int
	 */
	private $columnsOccupied = 0;

	/**
	 * Form or container this belong to
	 * @var Container
	 */
	private $container;
	/**
	 * @var string
	 */
	private $gridBreakpoint = 'md';
	/**
	 * @var string[]
	 */
	private $ownedNames = [];
	/**
	 * @var BootstrapCell[]
	 */
	private $cells = [];
	/**
	 * @var Html
	 */
	private $elementPrototype;

	/**
	 * BootstrapRow constructor.
	 * @param Container $container Form or container this belong to. Components will be added to this
	 *                             component
	 */
	public function __construct(Container $container)
	{
		$this->container = $container;
		$this->elementPrototype = Html::el('div', [
			'class' => ['row'],
		]);
	}

	/**
	 * Adds a new cell to which a control can be added.
	 * @param int $numOfColumns Number of grid columns to use up
	 */
	public function addCell($numOfColumns)
	{
		if ($this->columnsOccupied + $numOfColumns > $this->numOfColumns) {
			throw new InvalidArgumentException(
				"the given number of columns with combination of already used"
				. " columns exceeds column limit ({$this->numOfColumns})");
		}

		$cell = new BootstrapCell($this, $numOfColumns);
		$this->cells[] = $cell;
	}

	/**
	 * Delegate to underlying container and remember it.
	 * @param IComponent $component
	 * @param            $name
	 * @param null       $insertBefore
	 * @internal
	 */
	public function addComponent(IComponent $component, $name, $insertBefore = NULL)
	{
		$this->container->addComponent($component, $name, $insertBefore);
		$this->ownedNames[] = $name;
	}

	/**
	 * @return BootstrapCell[]
	 */
	public function getCells()
	{
		return $this->cells;
	}

	/**
	 * The container without content
	 * @return Html
	 */
	public function getElementPrototype()
	{
		return $this->elementPrototype;
	}

	/**
	 * @return string
	 */
	public function getGridBreakpoint()
	{
		return $this->gridBreakpoint;
	}

	/**
	 * Sets the xs, sm, md, lg part
	 * @param string $gridBreakpoint
	 * @return BootstrapRow
	 */
	public function setGridBreakpoint($gridBreakpoint)
	{
		$this->gridBreakpoint = $gridBreakpoint;

		return $this;
	}

	/**
	 * @return string[]
	 */
	public function getOwnedNames()
	{
		return $this->ownedNames;
	}
}