<?php declare (strict_types = 1);

namespace Tests\Rendering;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\RendererOptions;
use Nette\Application\UI\Presenter;
use Tests\BaseTestCase;

/**
 * The renderer marks controls it has drawn with RendererOptions::_RENDERED, which is the
 * same option key Nette itself sets from BaseControl::getControl(). These guard the overlap.
 */
class RenderedOptionTest extends BaseTestCase
{

	/** @var BootstrapForm */
	private $form;

	public function setUp(): void
	{
		$this->form = new BootstrapForm();
		$this->form->setParent($this->createStub(Presenter::class));
		$this->form->setAction('/');
	}

	public function testControlIsStillRenderedAfterItsControlHtmlWasFetched(): void
	{
		$this->form->addText('a', 'b');

		// Nette sets the 'rendered' option as a side effect of this
		$this->form->getComponent('a')->getControl();

		$this->assertStringContainsString('name="a"', $this->form->__toString(true));
	}

	public function testRenderingTwiceProducesTheSameOutput(): void
	{
		$this->form->addGroup('Group');
		$this->form->addText('a', 'b');
		$this->form->addSubmit('send', 'Send');

		$this->assertSame($this->form->__toString(true), $this->form->__toString(true));
	}

	public function testGroupedControlIsNotRenderedTwice(): void
	{
		$this->form->addGroup('Group');
		$this->form->addText('a', 'b');

		$html = $this->form->__toString(true);

		$this->assertSame(1, substr_count($html, 'name="a"'));
		$this->assertTrue($this->form->getComponent('a')->getOption(RendererOptions::_RENDERED));
	}

}
