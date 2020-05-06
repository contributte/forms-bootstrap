<?php declare (strict_types = 1);

namespace Tests\Grid;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Grid\BootstrapCell;
use Contributte\FormsBootstrap\Grid\BootstrapRow;
use Tests\BaseTest;

class BootstrapCellTest extends BaseTest
{

	/** @var BootstrapCell */
	protected $cell;

	protected function setUp(): void
	{
		$form = new BootstrapForm();
		$row = new BootstrapRow($form);
		$this->cell = new BootstrapCell($row, 12);
	}

	public function testAddClass(): void
	{
		$this->cell->addHtmlClass('new-class');
		$this->assertEquals('<div class="new-class col-sm-12"></div>', $this->cell->render()->render());
	}

}
