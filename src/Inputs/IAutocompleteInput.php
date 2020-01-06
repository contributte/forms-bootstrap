<?php

namespace Contributte\FormsBootstrap\Inputs;

/**
 * Interface IAutocompleteInput.
 * Inputs which have toggleable autocomplete.
 * @package Contributte\FormsBootstrap\Inputs
 */
interface IAutocompleteInput
{
	/**
	 * Gets the state of autocomplete: true=on,false=off,null=omit attribute
	 * @param $bool
	 * @return bool|null
	 */
	public function getAutocomplete($bool);

	/**
	 * Turns autocomplete on or off.
	 * @param bool|null $bool null to omit attribute (default)
	 * @return static
	 */
	public function setAutocomplete($bool);
}
