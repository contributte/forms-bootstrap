<?php
/**
 * Created by Petr Čech (czubehead).
 * Timestamp: 28.5.18 20:51
 */

namespace Czubehead\BootstrapForms\Traits;


use Czubehead\BootstrapForms\Grid\BootstrapRow;


/**
 * Trait AddRowTrait. Implements method to add a bootstrap row.
 * @package Czubehead\BootstrapForms\Traits
 */
trait AddRowTrait
{
	/**
	 * Adds a new Grid system row.
	 * @param string|null $name optional. If null is passed, it is generated.
	 * @return BootstrapRow
	 */
	public function addRow($name = NULL)
	{
		/** @noinspection PhpParamsInspection */
		$row = new BootstrapRow($this, $name);
		$this->addComponent($row, $row->name);

		return $row;
	}
}