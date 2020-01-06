<?php declare(strict_types = 1);

namespace Contributte\FormsBootstrap;

use Contributte\FormsBootstrap\Traits\AddRowTrait;
use Contributte\FormsBootstrap\Traits\BootstrapContainerTrait;
use Nette\Forms\Container;

/**
 * Class BootstrapContainer.
 * Container that has all the bootstrap add* methods.
 */
class BootstrapContainer extends Container
{

	use BootstrapContainerTrait;
	use AddRowTrait;

}
