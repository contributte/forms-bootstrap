<?php declare (strict_types = 1);

namespace Tests\Rendering;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Nette\Application\UI\Presenter;
use Tests\BaseTest;

class SideBySideTest extends BaseTest
{

	/** @var BootstrapForm  */
	private $form;

	protected function setUp(): void
	{
		$this->form = new BootstrapForm();
		$this->form->setRenderer(new BootstrapRenderer(RenderMode::SIDE_BY_SIDE_MODE));
		$this->form->setParent($this->createMock(Presenter::class));
	}

	public function testEmpty(): void
	{
		$this->expectOutputString($this->loadTextData('empty_form.html'));
		$this->form->render();
	}

	public function testMethodGet(): void
	{
		$this->form->setAction('?a=3&b=aw');
		$this->form->setMethod('get');
		$this->expectOutputString($this->loadTextData('method_get.html'));
		$this->form->render();
	}

	public function testTextInput(): void
	{
		$this->form->addText('a', 'b');
		$this->expectOutputString($this->loadTextData('side_by_side/text.html'));
		$this->form->render();
	}

	public function testCheckbox(): void
	{
		$this->form->addCheckbox('a', 'b');
		$this->expectOutputString($this->loadTextData('side_by_side/checkbox.html'));
		$this->form->render();
	}

	public function testCheckboxOnRightSide(): void
	{
		$this->form->addCheckbox('a', 'b')->setAllignWithInputControls();
		$this->expectOutputString($this->loadTextData('side_by_side/checkbox_right.html'));
		$this->form->render();
	}

	public function testSubmit(): void
	{
		$this->form->addSubmit('a', 'b');
		$this->expectOutputString($this->loadTextData('side_by_side/submit.html'));
		$this->form->render();
	}

	public function testSubmitOnRightSide(): void
	{
		$this->form->addSubmit('a', 'b')->setAllignWithInputControls();
		$this->expectOutputString($this->loadTextData('side_by_side/submit_right.html'));
		$this->form->render();
	}

	public function testTextArea(): void
	{
		$this->form->addTextArea('a', 'b');
		$this->expectOutputString($this->loadTextData('side_by_side/textarea.html'));
		$this->form->render();
	}


	public function testErrorRendering(): void
	{
		$this->form->addText('a')->addError('test-error');
		$this->expectOutputString($this->loadTextData('side_by_side/text-error.html'));
		$this->form->render();
	}

}
