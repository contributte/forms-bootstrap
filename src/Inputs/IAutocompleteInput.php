<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap\Inputs;

/**
 * Interface IAutocompleteInput.
 * Inputs which have toggleable autocomplete.
 */
interface IAutocompleteInput
{

	/**
	 * Gets the state of autocomplete: true=on,false=off,null=omit attribute
	 */
	public function getAutocomplete(): ?bool;

	/**
	 * Turns autocomplete on or off.
	 *
	 * @param bool|null $bool null to omit attribute (default)
	 * @return static
	 */
	public function setAutocomplete(?bool $bool);

}
