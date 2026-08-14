<?php declare (strict_types = 1);

namespace Tests\Rendering;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\RendererConfig as Cnf;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Nette\Application\UI\Presenter;
use Nette\InvalidArgumentException;
use Nette\Utils\Html;
use Tests\BaseTest;

/**
 * Exercises configElem() — the one function every drawn element goes through —
 * and the renderer's own accessors.
 */
class RendererConfigTest extends BaseTest
{

	private BootstrapRenderer $renderer;

	public function testClassSetReplacesExistingClasses(): void
	{
		$el = Html::el('div', ['class' => 'original']);

		$this->renderer->configElem([Cnf::CLASS_SET => ['brand-new']], $el);

		$this->assertSame('<div class="brand-new"></div>', (string) $el);
	}

	public function testClassAddKeepsExistingClasses(): void
	{
		$el = Html::el('div', ['class' => 'original']);

		$this->renderer->configElem([Cnf::CLASS_ADD => ['extra']], $el);

		$this->assertSame('<div class="original extra"></div>', (string) $el);
	}

	public function testClassRemoveDropsOnlyTheNamedClass(): void
	{
		$el = Html::el('div', ['class' => 'keep drop']);

		$this->renderer->configElem([Cnf::CLASS_REMOVE => ['drop']], $el);

		$this->assertSame('<div class="keep"></div>', (string) $el);
	}

	public function testAttributesAreApplied(): void
	{
		$el = Html::el('input');

		$this->renderer->configElem([Cnf::ATTRIBUTES => ['placeholder' => 'Type here']], $el);

		$this->assertSame('<input placeholder="Type here">', (string) $el);
	}

	public function testElementNameChangesTheTag(): void
	{
		$el = Html::el('div');

		$configured = $this->renderer->configElem([Cnf::ELEMENT_NAME => 'span'], $el);

		$this->assertNotNull($configured);
		$this->assertSame('<span></span>', (string) $configured);
	}

	public function testContainerWrapsTheElement(): void
	{
		$el = Html::el('input');

		$configured = $this->renderer->configElem([
			Cnf::CONTAINER => [
				Cnf::ELEMENT_NAME => 'div',
				Cnf::CLASS_SET => ['wrapper'],
			],
		], $el);

		$this->assertNotNull($configured);
		$this->assertSame('<div class="wrapper"><input></div>', (string) $configured);
	}

	public function testNullElementWithoutContainerStaysNull(): void
	{
		$this->assertNull($this->renderer->configElem([Cnf::CLASS_ADD => ['nothing-to-add-to']], null));
	}

	public function testStringConfigIsLookedUpInTheConfig(): void
	{
		$el = $this->renderer->configElem(Cnf::INPUT_INVALID, Html::el('input'));

		$this->assertNotNull($el);
		$this->assertStringContainsString('is-invalid', (string) $el);
	}

	public function testGridBreakPointAccessors(): void
	{
		$this->assertSame('sm', $this->renderer->getGridBreakPoint());

		$this->renderer->setGridBreakPoint('lg');

		$this->assertSame('lg', $this->renderer->getGridBreakPoint());
	}

	public function testBreakPointEndsUpInSideBySideColumnClasses(): void
	{
		$form = $this->sideBySideForm();
		$form->getRenderer()->setGridBreakPoint('lg');
		$form->addText('a', 'b');

		$this->assertStringContainsString('col-lg-3', $this->render($form));
	}

	public function testColumnsCanBeChanged(): void
	{
		$form = $this->sideBySideForm();
		$form->getRenderer()->setColumns(4);
		$form->addText('a', 'b');

		$html = $this->render($form);

		$this->assertStringContainsString('col-sm-4', $html);
		// the control takes whatever is left of the twelve
		$this->assertStringContainsString('col-sm-8', $html);
	}

	public function testColumnsCanBeSetExplicitly(): void
	{
		$form = $this->sideBySideForm();
		$form->getRenderer()->setColumns(2, 6);
		$form->addText('a', 'b');

		$html = $this->render($form);

		$this->assertStringContainsString('col-sm-2', $html);
		$this->assertStringContainsString('col-sm-6', $html);
	}

	public function testGroupHiddenAccessors(): void
	{
		$this->assertTrue($this->renderer->isGroupHidden());

		$this->renderer->setGroupHidden(false);

		$this->assertFalse($this->renderer->isGroupHidden());
	}

	public function testHiddenFieldsStayInPlaceWhenGroupingIsOff(): void
	{
		$form = new BootstrapForm();
		$form->setParent($this->createMock(Presenter::class));
		$form->setAction('/');
		$form->getRenderer()->setGroupHidden(false);
		$form->addHidden('secret', 'v');
		$form->addText('a', 'b');

		$html = $this->render($form);

		// the hidden input keeps its position instead of being moved to the end
		$this->assertLessThan(
			strpos($html, 'name="a"'),
			strpos($html, 'name="secret"')
		);
	}

	public function testModeAccessor(): void
	{
		$this->assertSame(RenderMode::VERTICAL_MODE, (new BootstrapRenderer())->getMode());
		$this->assertSame(
			RenderMode::SIDE_BY_SIDE_MODE,
			(new BootstrapRenderer(RenderMode::SIDE_BY_SIDE_MODE))->getMode()
		);
	}

	public function testRenderControlsRejectsNonContainer(): void
	{
		$this->expectException(InvalidArgumentException::class);

		$this->renderer->renderControls(Html::el('div'));
	}

	protected function setUp(): void
	{
		$this->renderer = new BootstrapRenderer();
	}

	private function sideBySideForm(): BootstrapForm
	{
		$form = new BootstrapForm();
		$form->setRenderer(new BootstrapRenderer(RenderMode::SIDE_BY_SIDE_MODE));
		$form->setParent($this->createMock(Presenter::class));
		$form->setAction('/');

		return $form;
	}

	private function render(BootstrapForm $form): string
	{
		ob_start();

		try {
			$form->render();

			return (string) ob_get_contents();
		} finally {
			ob_end_clean();
		}
	}

}
