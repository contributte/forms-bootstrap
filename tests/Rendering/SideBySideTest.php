<?php declare (strict_types = 1);

namespace Tests\Rendering;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Nette\Application\UI\Presenter;
use PHPUnit\Framework\TestCase;
use Tests\BaseTest;

class SideBySideTest extends BaseTest
{

	private $form;

	protected function setUp(): void
	{
		$this->form = new BootstrapForm();
		$this->form->setRenderer(new BootstrapRenderer(RenderMode::SIDE_BY_SIDE_MODE));
		$this->form->setParent($this->createMock(Presenter::class));
	}

	public function testEmpty()
	{
		$this->expectOutputString($this->loadTextData('empty_form.html'));
		$this->form->render();
	}

	public function testTextInput()
	{
		$this->form->addText('a', 'b');
		$this->expectOutputString($this->loadTextData('side_by_side/text.html'));
		$this->form->render();
	}

	public function testCheckbox()
	{
		$this->form->addCheckbox('a', 'b');
		$this->expectOutputString($this->loadTextData('side_by_side/checkbox.html'));
		$this->form->render();
	}

	public function testCheckboxOnRightSide()
	{
		$this->form->addCheckbox('a', 'b')->setAllignWithInputControls();
		$this->expectOutputString($this->loadTextData('side_by_side/checkbox_right.html'));
		$this->form->render();
	}

	public function testSubmit()
	{
		$this->form->addSubmit('a', 'b');
		$this->expectOutputString($this->loadTextData('side_by_side/submit.html'));
		$this->form->render();
	}

	public function testSubmitOnRightSide()
	{
		$this->form->addSubmit('a', 'b')->setAllignWithInputControls();
		$this->expectOutputString($this->loadTextData('side_by_side/submit_right.html'));
		$this->form->render();
	}
}
