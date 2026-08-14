<?php declare (strict_types = 1);

namespace Tests\Rendering;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\RendererOptions;
use Nette\Application\UI\Presenter;
use Tests\BaseTestCase;

/**
 * The renderer tracks what it has already drawn, so that a control belonging to a group is
 * not drawn again by the trailing pass. It must not confuse that with Nette's own 'rendered'
 * option, which BaseControl::getControl() sets on every fetch.
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

		// Nette sets its own 'rendered' option as a side effect of this
		$this->form->getComponent('a')->getControl();

		$this->assertStringContainsString('name="a"', $this->form->__toString(true));
	}

	/**
	 * Assisted manual rendering: renderControls() called on its own, with no render() ahead
	 * of it to reset anything. Fetching a control's html must not make it disappear.
	 */
	public function testAssistedRenderingIsNotDisturbedByFetchingControlHtml(): void
	{
		$this->form->addText('a', 'b');
		$this->form->addText('c', 'd');

		$renderer = $this->form->getRenderer();
		$renderer->attachForm($this->form);

		$this->form->getComponent('a')->getControl();

		$html = $renderer->renderControls($this->form);

		$this->assertStringContainsString('name="a"', $html);
		$this->assertStringContainsString('name="c"', $html);
	}

	/**
	 * The escape hatch of marking a control rendered by hand still works.
	 */
	public function testControlMarkedRenderedByHandIsSkipped(): void
	{
		$this->form->addText('a', 'b');
		$this->form->addText('c', 'd');

		$renderer = $this->form->getRenderer();
		$renderer->attachForm($this->form);
		$this->form->getComponent('a')->setOption(RendererOptions::_RENDERED, true);

		$html = $renderer->renderControls($this->form);

		$this->assertStringNotContainsString('name="a"', $html);
		$this->assertStringContainsString('name="c"', $html);
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
