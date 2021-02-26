<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Grid;

use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\RendererConfig;
use Contributte\FormsBootstrap\Traits\BootstrapContainerTrait;
use Nette\ComponentModel\IComponent;
use Nette\Forms\Control;
use Nette\Forms\ControlGroup;
use Nette\SmartObject;
use Nette\Utils\Html;

/**
 * Class BootstrapCell.
 * Represents a row-column pair = table cell in Bootstrap grid system. This is the part with col-*-* class.
 * Only one component can be present.
 *
 * @property-read int  $numOfColumns     Number of Bootstrap columns to occupy
 * @property-read Control $childControls|null     Nested child control if any
 * @property-read Html $elementPrototype the Html div that will be rendered. You may define additional
 *                properties.
 */
class BootstrapCell
{

	use SmartObject;
	use BootstrapContainerTrait;

	/**
	 * Only use 'col' class (auto stretch)
	 */
	public const COLUMNS_NONE = 0;

	/**
	 * Use 'col-auto'
	 */
	public const COLUMNS_AUTO = null;

	/** @var ControlGroup|null */
	protected $currentGroup;

	/** @var int|false|null */
	private $numOfColumns;

	/** @var Control[]|null */
	private $childControls = [];

	/** @var BootstrapRow */
	private $row;

	/** @var Html */
	private $elementPrototype;

	/**
	 * @param BootstrapRow   $row          Row this is a child of
	 * @param int|false|null $numOfColumns Number of Bootstrap columns to occupy. You can use an integer or
	 * BootstrapCell::COLUMNS_* constant (see their docs for more)
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
	 */
	public function getElementPrototype(): Html
	{
		return $this->elementPrototype;
	}

	/**
	 * @return int|false|null
	 * @see BootstrapCell::$numOfColumns
	 */
	public function getNumOfColumns()
	{
		return $this->numOfColumns;
	}

	/**
	 * Renders the cell into Html object
	 */
	public function render(): Html
	{
		$element = $this->elementPrototype;

		/** @var BootstrapRenderer $renderer */
		$renderer = $this->row->getParent()->form->renderer;

		$element = $renderer->configElem(RendererConfig::GRID_CELL, $element);
		$element->class[] = $this->createClass();

		foreach ($this->childControls as $childControl) {
			$pairHtml = $renderer->renderPair($childControl);
			$element->addHtml($pairHtml);
		}

		return $element;
	}

	/**
	 * Delegate to underlying component.
	 *
	 * @param null $insertBefore
	 */
	public function addComponent(IComponent $component, ?string $name, $insertBefore = null): void
	{
		/** @noinspection PhpInternalEntityUsedInspection */
		$this->row->addComponent($component, $name, $insertBefore);
		$this->childControls[] = $component;
	}

	public function getCurrentGroup(): ?ControlGroup
	{
		return $this->currentGroup;
	}

	public function setCurrentGroup(?ControlGroup $currentGroup): self
	{
		$this->currentGroup = $currentGroup;

		return $this;
	}

	/**
	 * Creates column class based on numOfColumns
	 */
	protected function createClass(): string
	{
		$cols = $this->numOfColumns;

		if ($cols === self::COLUMNS_NONE) {
			return 'col';
		}

		if ($cols === self::COLUMNS_AUTO) {
			return 'col-auto';
		}

		return $this->row->gridBreakPoint !== null ? 'col-' . $this->row->gridBreakPoint . '-' . $this->numOfColumns : 'col-' . $this->numOfColumns;
	}

	/**
	 * @return static
	 */
	public function addHtmlClass(string $class)
	{
		$this->elementPrototype->class[] = $class;

		return $this;
	}

}
