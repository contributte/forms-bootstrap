<?php
/**
 * Created by Petr Čech (czubehead).
 * Timestamp: 20.5.18 17:01
 */

namespace Czubehead\BootstrapForms\Grid;

use Czubehead\BootstrapForms\Traits\FakeControlTrait;
use Nette\ComponentModel\IComponent;
use Nette\ComponentModel\IContainer;
use Nette\Forms\Container;
use Nette\Forms\IControl;
use Nette\InvalidArgumentException;
use Nette\SmartObject;
use Nette\Utils\Html;


/**
 * Class BootstrapRow.
 * Represents a row in Bootstrap grid system.
 * @package Czubehead\BootstrapForms\Grid
 * @property string               $gridBreakPoint   Bootstrap breakpoint - usually xs, sm, md, lg. sm by
 *           default. Use NULL for no breakpoint.
 * @property-read string[]        $ownedNames       list of names of components which were added to this row
 * @property-read BootstrapCell[] $cells            cells in this row
 * @property-read Html            $elementPrototype the Html div that will be rendered. You may define
 *                additional properties.
 * @property-read string          $name             name of component
 */
class BootstrapRow implements IComponent, IControl
{
	use SmartObject;
	use FakeControlTrait;

	/**
	 * Global name counter
	 * @var int
	 */
	private static $uidCounter = 0;
	/**
	 * Number of columns in Bootstrap grid. Default is 12, but it can be customized.
	 * @var int
	 */
	public $numOfColumns = 12;
	/**
	 * @var string $name
	 */
	private $name;
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
	private $gridBreakPoint = 'sm';
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
	 * @var array
	 */
	private $options = [];

	/**
	 * BootstrapRow constructor.
	 * @param Container $container Form or container this belongs to. Components will be added to this
	 * @param null      $name      Optional name of this row. If none is supplied, it is generated
	 *                             automatically.
	 */
	public function __construct(Container $container, $name = NULL)
	{
		$this->container = $container;
		if (!$name) {
			$name = 'bootstrap_row_' . ++self::$uidCounter;
		}
		$this->name = $name;

		$this->elementPrototype = Html::el('div', [
			'class' => ['row'],
		]);
	}

	/**
	 * Adds a new cell to which a control can be added.
	 * @param int $numOfColumns Number of grid columns to use up
	 * @return BootstrapCell the cell added.
	 */
	public function addCell($numOfColumns = BootstrapCell::COLUMNS_NONE)
	{
		if ($this->columnsOccupied + $numOfColumns > $this->numOfColumns) {
			throw new InvalidArgumentException(
				"the given number of columns with combination of already used"
				. " columns exceeds column limit ({$this->numOfColumns})");
		}

		$cell = new BootstrapCell($this, $numOfColumns);
		$this->cells[] = $cell;

		return $cell;
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
	public function getGridBreakPoint()
	{
		return $this->gridBreakPoint;
	}

	/**
	 * Sets the xs, sm, md, lg part.
	 * @see BootstrapRow::$gridBreakPoint
	 * @param string $gridBreakPoint . NULL for no breakpoint.
	 * @return BootstrapRow
	 */
	public function setGridBreakPoint($gridBreakPoint)
	{
		$this->gridBreakPoint = $gridBreakPoint;

		return $this;
	}

	/**
	 * Component name
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Returns the container
	 * @return Container
	 */
	public function getParent()
	{
		return $this->container;
	}

	/**
	 * Sets the container
	 * @param Container|NULL $parent
	 * @param null           $name ignored
	 */
	public function setParent(IContainer $parent = NULL, $name = NULL)
	{
		$this->container = $parent;
	}

	/**
	 * Gets previously set option
	 * @param string $option
	 * @param null   $default
	 * @return mixed|null
	 */
	public function getOption($option, $default = NULL)
	{
		return isset($this->options[ $option ]) ? $this->options[ $option ] : $default;
	}

	/**
	 * @return string[]
	 */
	public function getOwnedNames()
	{
		return $this->ownedNames;
	}


	/**
	 * Renders the row into a Html object
	 * @return Html
	 */
	public function render()
	{
		$element = $this->elementPrototype;
		foreach ($this->cells as $cell) {
			$cellHtml = $cell->render();
			$element->addHtml($cellHtml);
		}

		return $element;
	}

	/**
	 * Sets option
	 * @param $option
	 * @param $value
	 * @internal
	 */
	public function setOption($option, $value)
	{
		$this->options[ $option ] = $value;
	}
}