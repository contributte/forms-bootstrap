<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Traits;

use Contributte\FormsBootstrap\BootstrapUtils;
use Nette\Utils\Html;

/**
 * Trait BootstrapButtonTrait. Modifies an existing button class such that it returns a bootstrap button.
 *
 * @property string $btnType
 */
trait BootstrapButtonTrait
{

	/**
	 * set to true so that buttons by defaults are alligned on right with input fields
	 *
	 * @var bool
	 */
	public static $defaultAllignWithInputControls = false;

	/**
	 * set to true to allign buttons to right with all other input controls
	 *
	 * @var bool|null
	 */
	public $allignWithInputControls;

	/** @var string */
	private $btnClass = 'btn-primary';

	/**
	 * Gets additional button class. Default is btn-primary.
	 */
	public function getBtnClass(): string
	{
		return $this->btnClass;
	}

	/**
	 * Sets additional button class. Default is btn-primary
	 *
	 * @return static
	 */
	public function setBtnClass(string $btnClass)
	{
		$this->btnClass = $btnClass;

		return $this;
	}

	/**
	 * @param string|null $caption
	 */
	public function getControl($caption = null): Html
	{
		$control = parent::getControl($caption);
		$this->addBtnClass($control);

		return $control;
	}

	public function allignWithInputControls(): bool
	{
		return $this->allignWithInputControls ?? self::$defaultAllignWithInputControls;
	}

	public function setAllignWithInputControls(bool $allignWithControls = true): void
	{
		$this->allignWithInputControls = $allignWithControls;
	}

	protected function addBtnClass(Html $element): void
	{
		BootstrapUtils::standardizeClass($element);
		$element->class[] = 'btn ' . $this->getBtnClass();
	}

}
