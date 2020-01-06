<?php

namespace Contributte\FormsBootstrap\Traits;


use Contributte\FormsBootstrap\Grid\BootstrapRow;


/**
 * Trait AddRowTrait. Implements method to add a bootstrap row.
 * @package Contributte\FormsBootstrap\Traits
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
