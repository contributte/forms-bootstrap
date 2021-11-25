<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Grid;

use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\RendererConfig;
use Contributte\FormsBootstrap\Enums\RendererOptions;
use Contributte\FormsBootstrap\Traits\FakeControlTrait;
use Nette\ComponentModel\IComponent;
use Nette\ComponentModel\IContainer;
use Nette\Forms\Container;
use Nette\Forms\Control;
use Nette\InvalidArgumentException;
use Nette\SmartObject;
use Nette\Utils\Html;

/**
 * Class BootstrapRow.
 * Represents a row in Bootstrap grid system.
 *
 * @property string               $gridBreakPoint   Bootstrap breakpoint - usually xs, sm, md, lg. sm by
 *           default. Use NULL for no breakpoint.
 * @property-read string[]        $ownedNames       list of names of components which were added to this row
 * @property-read BootstrapCell[] $cells            cells in this row
 * @property-read Html            $elementPrototype the Html div that will be rendered. You may define
 *                additional properties.
 * @property-read string          $name             name of component
 */
class BootstrapRow implements IComponent, Control
{

	use SmartObject;
	use FakeControlTrait;

	/**
	 * Global name counter
	 *
	 * @var int
	 */
	private static $uidCounter = 0;

	/**
	 * Number of columns in Bootstrap grid. Default is 12, but it can be customized.
	 *
	 * @var int
	 */
	public $numOfColumns = 12;

	/** @var string $name */
	private $name;

	/**
	 * Number of columns used by added cells.
	 *
	 * @var int
	 */
	private $columnsOccupied = 0;

	/**
	 * Form or container this belong to
	 *
	 * @var Container
	 */
	private $container;

	/** @var string */
	private $gridBreakPoint = 'sm';

	/** @var string[] */
	private $ownedNames = [];

	/** @var BootstrapCell[] */
	private $cells = [];

	/** @var Html */
	private $elementPrototype;

	/** @var mixed[] */
	private $options = [];

	/**
	 * @param Container $container Form or container this belongs to. Components will be added to this
	 * @param string|null      $name      Optional name of this row. If none is supplied, it is generated
	 *                             automatically.
	 */
	public function __construct(Container $container, $name = null)
	{
		$this->container = $container;
		if (!$name) {
			$name = 'bootstrap_row_' . ++self::$uidCounter;
		}

		$this->name = $name;

		$this->elementPrototype = Html::el();
	}

	/**
	 * Adds a new cell to which a control can be added.
	 */
	public function addCell(int $numOfColumns = BootstrapCell::COLUMNS_NONE): BootstrapCell
	{
		if ($this->columnsOccupied + $numOfColumns > $this->numOfColumns) {
			throw new InvalidArgumentException(
				'the given number of columns with combination of already used'
				. ' columns exceeds column limit (' . $this->numOfColumns . ')'
			);
		}

		$cell = new BootstrapCell($this, $numOfColumns);
		$this->cells[] = $cell;

		return $cell;
	}

	/**
	 * Delegate to underlying container and remember it.
	 *
	 * @internal
	 */
	public function addComponent(IComponent $component, ?string $name = null, ?string $insertBefore = null): void
	{
		$this->container->addComponent($component, $name, $insertBefore);
		$this->ownedNames[] = $name;
	}

	/**
	 * @return BootstrapCell[]
	 * @see BootstrapRow::$cells
	 */
	public function getCells(): array
	{
		return $this->cells;
	}

	/**
	 * The container without content
	 *
	 * @see BootstrapRow::$elementPrototype
	 */
	public function getElementPrototype(): Html
	{
		return $this->elementPrototype;
	}

	/**
	 * @see BootstrapRow::$gridBreakPoint
	 */
	public function getGridBreakPoint(): string
	{
		return $this->gridBreakPoint;
	}

	/**
	 * Sets the xs, sm, md, lg part.
	 *
	 * @see BootstrapRow::$gridBreakPoint
	 * @param string $gridBreakPoint . NULL for no breakpoint.
	 */
	public function setGridBreakPoint(string $gridBreakPoint): BootstrapRow
	{
		$this->gridBreakPoint = $gridBreakPoint;

		return $this;
	}

	/**
	 * Component name
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * Returns the container
	 *
	 * @return Container
	 */
	public function getParent(): IContainer
	{
		return $this->container;
	}

	/**
	 * Sets the container
	 *
	 * @param Container|NULL $parent
	 * @param null $name ignored
	 */
	public function setParent(?IContainer $parent = null, ?string $name = null): IComponent
	{
		$this->container = $parent;

		return $this;
	}

	/**
	 * Gets previously set option
	 *
	 * @param mixed|null $default
	 * @return mixed|null
	 */
	public function getOption(string $option, $default = null)
	{
		return $this->options[$option] ?? $default;
	}

	/**
	 * Renders the row into a Html object
	 */
	public function render(): Html
	{
		/** @var BootstrapRenderer $renderer */
		$renderer = $this->container->form->renderer;

		$element = $renderer->configElem(RendererConfig::GRID_ROW, $this->elementPrototype);
		foreach ($this->cells as $cell) {
			$cellHtml = $cell->render();
			$element->addHtml($cellHtml);
		}

		$this->setOption(RendererOptions::_RENDERED, true);

		return $element;
	}

	/**
	 * Sets option
	 *
	 * @param mixed|null $value
	 * @internal
	 */
	public function setOption(string $option, $value): void
	{
		$this->options[$option] = $value;
	}

}
