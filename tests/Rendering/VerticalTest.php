<?php declare (strict_types = 1);

namespace Tests\Rendering;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Nette\Application\UI\Presenter;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseTestCase;

/**
 * Snapshot tests for the vertical render mode, the renderer's default.
 * Side-by-side is covered by SideBySideTest.
 */
class VerticalTest extends BaseTestCase
{

	/** @var BootstrapForm */
	private $form;

	/**
	 * @return array<string, array{string, callable(BootstrapForm): void}>
	 */
	public static function provideForms(): array
	{
		return [
			'text' => [
				'vertical/text.html',
				function (BootstrapForm $form): void {
					$form->addText('a', 'b');
				}],
			'text with description' => [
			'vertical/text_description.html',
			function (BootstrapForm $form): void {
				$form->addText('a', 'b')->setOption('description', 'Helpful hint');
			}],
			'checkbox' => [
			'vertical/checkbox.html',
			function (BootstrapForm $form): void {
				$form->addCheckbox('a', 'b');
			}],
			'checkbox list' => [
			'vertical/checkbox_list.html',
			function (BootstrapForm $form): void {
				$form->addCheckboxList('a', 'b', ['x' => 'X', 'y' => 'Y']);
			}],
			'radio list' => [
			'vertical/radio_list.html',
			function (BootstrapForm $form): void {
				$form->addRadioList('a', 'b', ['x' => 'X', 'y' => 'Y']);
			}],
			'select' => [
			'vertical/select.html',
			function (BootstrapForm $form): void {
				$form->addSelect('a', 'b', ['x' => 'X', 'y' => 'Y']);
			}],
			'textarea' => [
			'vertical/textarea.html',
			function (BootstrapForm $form): void {
				$form->addTextArea('a', 'b');
			}],
			'submit' => [
			'vertical/submit.html',
			function (BootstrapForm $form): void {
				$form->addSubmit('a', 'b');
			}],
			'error' => [
			'vertical/text_error.html',
			function (BootstrapForm $form): void {
				$form->addText('a')->addError('test-error');
			}],
			'form own error' => [
			'vertical/form_error.html',
			function (BootstrapForm $form): void {
				$form->addText('a', 'b');
				$form->addError('whole form is wrong');
			}],
			'grid row' => [
			'vertical/grid.html',
			function (BootstrapForm $form): void {
				$row = $form->addRow();
				$row->addCell(6)->addText('name', 'Name');
				$row->addCell(6)->addText('mail', 'Mail');
			}],
			'hidden field is grouped last' => [
			'vertical/hidden.html',
			function (BootstrapForm $form): void {
				$form->addHidden('secret', 'v');
				$form->addText('a', 'b');
			}],
		];
	}

	/**
	 * @param callable(BootstrapForm): void $build
	 */
	#[DataProvider('provideForms')]
	public function testRendering(string $fixture, callable $build): void
	{
		$build($this->form);
		$this->expectOutputString($this->loadTextData($fixture));
		$this->form->render();
	}

	public function testVerticalIsTheDefaultMode(): void
	{
		$form = new BootstrapForm();

		$this->assertSame(RenderMode::VERTICAL_MODE, $form->getRenderMode());
	}

	protected function setUp(): void
	{
		$this->form = new BootstrapForm();
		$this->form->setRenderer(new BootstrapRenderer(RenderMode::VERTICAL_MODE));
		$this->form->setParent($this->createMock(Presenter::class));
		// A real (non-empty) action makes Nette inject the "_do" signal field,
		// mirroring production where the form is attached to a routed presenter.
		$this->form->setAction('/');
	}

}
