<?php declare (strict_types = 1);

namespace Tests\Grid;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Grid\BootstrapCell;
use Contributte\FormsBootstrap\Grid\BootstrapRow;
use Nette\Application\UI\Presenter;
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
