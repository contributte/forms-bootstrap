<?php declare (strict_types = 1);

namespace Tests\Grid;

use ArrayObject;
use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Grid\BootstrapCell;
use Contributte\FormsBootstrap\Grid\BootstrapRow;
use Nette\Application\UI\Presenter;
use Nette\Forms\Form;
use Nette\NotImplementedException;
use Tests\BaseTestCase;

/**
 * The row/cell objects themselves, and the "fake control" surface that lets a
 * row sit in the component tree without being a real form value.
 */
class BootstrapRowTest extends BaseTestCase
{

	private BootstrapForm $form;

	private BootstrapRow $row;

	public function testCellsAreCollected(): void
	{
		$this->assertSame([], $this->row->getCells());

		$first = $this->row->addCell(6);
		$second = $this->row->addCell(6);

		$this->assertSame([$first, $second], $this->row->getCells());
		$this->assertContainsOnlyInstancesOf(BootstrapCell::class, $this->row->getCells());
	}

	public function testCellRemembersHowManyColumnsItSpans(): void
	{
		$cell = $this->row->addCell(4);

		$this->assertSame(4, $cell->getNumOfColumns());
	}

	public function testCellPrototypeCanBeDecorated(): void
	{
		$cell = $this->row->addCell(6);

		$cell->getElementPrototype()->setAttribute('data-role', 'left');

		$this->assertStringContainsString('data-role="left"', (string) $cell->render());
	}

	public function testRowPrototypeCanBeDecorated(): void
	{
		$this->row->getElementPrototype()->setAttribute('data-role', 'row');
		$this->row->addCell(12)->addText('a');

		$this->assertStringContainsString('data-role="row"', $this->renderForm());
	}

	public function testGridBreakPointAccessors(): void
	{
		$this->assertSame('sm', $this->row->getGridBreakPoint());

		$this->row->setGridBreakPoint('md');

		$this->assertSame('md', $this->row->getGridBreakPoint());
	}

	public function testBreakPointReachesTheRenderedColumnClass(): void
	{
		$this->row->setGridBreakPoint('lg');
		$this->row->addCell(4)->addText('a');

		$this->assertStringContainsString('col-lg-4', $this->renderForm());
	}

	public function testOwnedNamesListsWhatWasAddedThroughTheRow(): void
	{
		$this->assertSame([], $this->row->getOwnedNames());

		$this->row->addCell(6)->addText('name');
		$this->row->addCell(6)->addText('mail');

		$this->assertSame(['name', 'mail'], $this->row->getOwnedNames());
	}

	public function testRowIsNotRealFormValue(): void
	{
		$this->assertSame([], $this->row->getErrors());
		$this->assertNull($this->row->getValue());
		$this->assertTrue($this->row->isDisabled());
		$this->assertTrue($this->row->isOmitted());
	}

	public function testRowCannotBeGivenValue(): void
	{
		$this->expectException(NotImplementedException::class);

		$this->row->setValue('anything');
	}

	public function testValidatingRowDoesNothing(): void
	{
		$this->row->addCell(12)->addText('a')->setRequired('required');

		$this->row->validate();

		$this->assertSame([], $this->row->getErrors());
	}

	public function testControlsAddedThroughCellStayReachableOnForm(): void
	{
		$this->row->addCell(12)->addText('name', 'Name');

		$this->assertSame('name', $this->form['name']->getName());
	}

	public function testRowHasNoLabelAndIsNeverRequired(): void
	{
		$this->assertNull($this->row->getLabel());
		$this->assertNull($this->row->getLabel('caption'));
		$this->assertFalse($this->row->isRequired());
	}

	public function testOptionsRoundTrip(): void
	{
		$this->row->setOption('description', 'Hello');

		$this->assertSame('Hello', $this->row->getOption('description'));
	}

	public function testUnsetOptionIsNullAndDoesNotWarn(): void
	{
		$warnings = new ArrayObject();
		set_error_handler(
			static function (int $severity, string $message) use ($warnings): bool {
				$warnings[] = $message;

				return true;
			},
			E_WARNING,
		);

		try {
			$value = $this->row->getOption('never-set');
		} finally {
			restore_error_handler();
		}

		$this->assertNull($value);
		$this->assertSame([], $warnings->getArrayCopy());
	}

	public function testLookupPathOfRowDirectlyOnForm(): void
	{
		$this->assertSame($this->row->getName(), $this->row->lookupPath(Form::class));
	}

	public function testLookupPathOfRowInsideContainer(): void
	{
		$container = $this->form->addContainer('sub');
		$nested = $container->addRow();

		$this->assertSame('sub-' . $nested->getName(), $nested->lookupPath(Form::class));
	}

	/**
	 * The fake control must report its path exactly like a real sibling would,
	 * whatever the form happens to be attached to.
	 */
	public function testLookupPathMatchesRealControlInSamePlace(): void
	{
		$container = $this->form->addContainer('sub');
		$nested = $container->addRow();
		$real = $container->addText('x');

		$expected = static fn (string $path): string => substr($path, 0, -strlen('x')) . $nested->getName();

		$this->assertSame($expected($real->lookupPath(Form::class)), $nested->lookupPath(Form::class));
		$this->assertSame($expected((string) $real->lookupPath()), $nested->lookupPath());
	}

	protected function setUp(): void
	{
		$this->form = new BootstrapForm();
		$this->row = $this->form->addRow();
		$this->form->setParent($this->createStub(Presenter::class));
		// A real (non-empty) action makes Nette inject the "_do" signal field,
		// mirroring production where the form is attached to a routed presenter.
		$this->form->setAction('/');
	}

	/**
	 * A row can only be drawn as part of a form render — that is when the
	 * renderer learns which form it is working for.
	 */
	private function renderForm(): string
	{
		ob_start();

		try {
			$this->form->render();

			return (string) ob_get_contents();
		} finally {
			ob_end_clean();
		}
	}

}
