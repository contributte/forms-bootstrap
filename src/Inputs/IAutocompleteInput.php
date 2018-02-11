<?php
/**
 * Created by Petr Čech (czubehead).
 * Timestamp: 11.2.18 23:12
 */

namespace Czubehead\BootstrapForms\Inputs;


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