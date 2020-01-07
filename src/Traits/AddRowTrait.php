<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Traits;

use Contributte\FormsBootstrap\Grid\BootstrapRow;

/**
 * Trait AddRowTrait. Implements method to add a bootstrap row.
 */
trait AddRowTrait
{

	/**
	 * Adds a new Grid system row.
	 *
	 * @param string|null $name optional. If null is passed, it is generated.
	 */
	public function addRow(?string $name = null): BootstrapRow
	{
		/** @noinspection PhpParamsInspection */
		$row = new BootstrapRow($this, $name);
		$this->addComponent($row, $row->name);

		return $row;
	}

}
