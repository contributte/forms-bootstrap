<?php

declare(strict_types = 1);
namespace Contributte\FormsBootstrap\Controls;

use Contributte\FormsBootstrap\Traits\FakeControlTrait;
use Nette\ComponentModel\IComponent;
use Nette\ComponentModel\IContainer;
use Nette\Forms\Container;
use Nette\Forms\Control;
use Nette\SmartObject;

abstract class CustomControl implements IComponent, Control
{

	use SmartObject;
	use FakeControlTrait;

	/**
	 * Form or container this belong to
	 *
	 * @var Container
	 */
	private $container;

	/** @var string */
	private $name;

	/** @var mixed[] */
	private $options = [];

	/**
	 *
	 * @return Container|NULL
	 */
	public function getContainer(): ?Container
	{
		return $this->container;
	}

	/**
	 *
	 * @param Container $container
	 */
	public function setContainer(Container $container): void
	{
		$this->container = $container;
	}

	/**
	 * Returns component name
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * Sets component name
	 *
	 * @param string $name
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
	}

	/**
	 * Returns the container
	 *
	 * @return Container
	 */
	public function getParent(): IContainer
	{
		return $this->container;
	}

	/**
	 * Sets the container
	 *
	 * @param Container|NULL $parent
	 * @param null $name
	 *        	ignored
	 */
	public function setParent(?IContainer $parent = null, ?string $name = null): IComponent
	{
		$this->container = $parent;

		return $this;
	}

	/**
	 * Gets previously set option
	 *
	 * @param mixed|null $default
	 * @return mixed|null
	 */
	public function getOption(string $option, $default = null)
	{
		return $this->options[$option] ?? $default;
	}

	/**
	 * Sets option
	 *
	 * @param mixed|null $value
	 * @internal
	 */
	public function setOption(string $option, $value): void
	{
		$this->options[$option] = $value;
	}

	/**
	 * Delegate to underlying container and remember it.
	 *
	 * @internal
	 */
	public function addComponent(IComponent $component, ?string $name = null, ?string $insertBefore = null): void
	{
		$this->container->addComponent($component, $name, $insertBefore);
	}

	abstract public function render();

}