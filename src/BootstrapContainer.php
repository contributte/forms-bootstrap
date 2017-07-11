<?php
/**
 * Created by Petr Čech (czubehead) : https://petrcech.eu
 * Date: 9.7.17
 * Time: 20:02
 * This file belongs to the project bootstrap-4-forms
 * https://github.com/czubehead/bootstrap-4-forms
 */

namespace Czubehead\BootstrapForms;


use Czubehead\BootstrapForms\Traits\BootstrapContainerTrait;
use Nette\Forms\Container;


/**
 * Class BootstrapContainer.
 * Container that has all the bootstrap add* methods.
 * @package Czubehead\BootstrapForms
 */
class BootstrapContainer extends Container
{
	use BootstrapContainerTrait;
}