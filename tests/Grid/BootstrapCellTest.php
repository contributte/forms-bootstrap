<?php declare (strict_types = 1);

namespace Tests\Grid;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Grid\BootstrapCell;
use Contributte\FormsBootstrap\Grid\BootstrapRow;
use Nette\Application\UI\Presenter;
use Nette\InvalidArgumentException;
use Tests\BaseTest;

class BootstrapCellTest extends BaseTest
{

	/** @var BootstrapCell */
	private $cell;

	/** @var BootstrapForm */
	private $form;

	/** @var BootstrapRow */
	private $row;

	protected function setUp(): void
	{
		$this->form = new BootstrapForm();
		$this->row = $this->form->addRow();
		$this->cell = $this->row->addCell(12);
		$this->form->setParent($this->createMock(Presenter::class));
	}

	public function testAddClass(): void
	{
		$this->cell->addHtmlClass('new-class');
		$this->assertEquals('<div class="new-class col-sm-12"></div>', $this->cell->render()->render());
	}

	public function testAddMultipleButtons(): void
	{
		$this->cell->addSubmit('first', 'First');
		$this->cell->addSubmit('second', 'Second');
		$this->form->render();
		$this->expectOutputString($this->loadTextData('cell_with_2_submits.html'));
	}

	public function testMoreCellThenAvailable(): void
	{
		$this->expectException(InvalidArgumentException::class);
		$this->row->addCell(15);
	}

	public function testGroup(): void
	{
		$first = $this->form->addGroup('first');
		$first->add($this->form->addText('a'));
		$this->form->addGroup('second');
		$this->cell->setCurrentGroup($first);

		$this->assertEquals($first, $this->cell->getCurrentGroup());
	}

}
