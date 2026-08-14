<?php declare (strict_types = 1);

namespace Tests\Rendering;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Nette\Forms\Blueprint;
use Nette\Forms\Form;
use Tests\BaseTestCase;

/**
 * Nette\Forms\Blueprint is what the {formPrint} Latte macro runs on. It renders a dummy
 * plain Nette form through a clone of the form's own renderer.
 *
 * @see https://github.com/contributte/forms-bootstrap/issues/63
 */
class BlueprintTest extends BaseTestCase
{

	public function testGeneratesLatteForPlainForm(): void
	{
		$form = new BootstrapForm();
		$form->addText('name', 'Name');
		$form->addSubmit('send', 'Send');

		$latte = (new Blueprint())->generateLatte($form);

		$this->assertStringContainsString('{label name/}', $latte);
		$this->assertStringContainsString('{input name}', $latte);
		$this->assertStringContainsString('{input send}', $latte);
		$this->assertStringContainsString('{inputError name}', $latte);
	}

	public function testKeepsBootstrapMarkupAroundPlaceholders(): void
	{
		$form = new BootstrapForm();
		$form->setRenderMode(RenderMode::SIDE_BY_SIDE_MODE);
		$form->addText('name', 'Name');

		$latte = (new Blueprint())->generateLatte($form);

		// the point of a bootstrap blueprint: the wrappers are the ones this renderer emits
		$this->assertStringContainsString('class="form-group row"', $latte);
		$this->assertStringContainsString('class="col-sm-9"', $latte);
	}

	public function testLabelPlaceholderIsNotNestedInAnotherLabel(): void
	{
		$form = new BootstrapForm();
		$form->addText('name', 'Name');

		$latte = (new Blueprint())->generateLatte($form);

		// {label name/} expands to a whole <label>, so it must not sit inside one
		$this->assertStringNotContainsString('<label', $latte);
	}

	public function testGroupedControlsAreRenderedOnce(): void
	{
		$form = new BootstrapForm();
		$form->addGroup('Personal');
		$form->addText('name', 'Name');
		$form->addGroup('Other');
		$form->addSelect('color', 'Color', ['r' => 'Red']);

		$latte = (new Blueprint())->generateLatte($form);

		$this->assertSame(1, substr_count($latte, '{input name}'));
		$this->assertSame(1, substr_count($latte, '{input color}'));
		$this->assertStringContainsString('<legend>Personal</legend>', $latte);
		$this->assertStringContainsString('<legend>Other</legend>', $latte);
	}

	public function testHandlesContainersAndHiddenFields(): void
	{
		$form = new BootstrapForm();
		$form->addHidden('token', 'x');
		$form->addContainer('sub')->addText('nested', 'Nested');

		$latte = (new Blueprint())->generateLatte($form);

		$this->assertStringContainsString('{input sub-nested}', $latte);
		$this->assertStringContainsString('{input token}', $latte);
	}

	/**
	 * A BootstrapRow is a fake control, but Blueprint still walks it like any other.
	 */
	public function testHandlesGridRowsWithoutFailing(): void
	{
		$form = new BootstrapForm();
		$row = $form->addRow();
		$row->addCell(6)->addText('first', 'First');
		$row->addCell(6)->addText('last', 'Last');

		$latte = (new Blueprint())->generateLatte($form);

		$this->assertStringContainsString('{input first}', $latte);
		$this->assertStringContainsString('{input last}', $latte);
	}

	public function testBootstrap5Blueprint(): void
	{
		BootstrapForm::switchBootstrapVersion(BootstrapVersion::V5);

		try {
			$form = new BootstrapForm();
			$form->setRenderMode(RenderMode::SIDE_BY_SIDE_MODE);
			$form->addText('name', 'Name');

			$latte = (new Blueprint())->generateLatte($form);

			$this->assertStringContainsString('{input name}', $latte);
			// the v5 wrapper, not v4's form-group/form-row
			$this->assertStringContainsString('class="mb-3 row"', $latte);
			$this->assertStringNotContainsString('form-group', $latte);
		} finally {
			BootstrapForm::switchBootstrapVersion(BootstrapVersion::V4);
		}
	}

	/**
	 * Blueprint hands the renderer a plain form; this is that capability on its own.
	 */
	public function testRendererDrawsPlainNetteForm(): void
	{
		$form = new Form();
		$form->addText('field', 'Field');

		$html = (new BootstrapRenderer())->render($form);

		$this->assertStringContainsString('name="field"', $html);
		$this->assertStringContainsString('class="form-group"', $html);
	}

	public function testClonedRendererDrawsPlainNetteForm(): void
	{
		$bootstrapForm = new BootstrapForm();
		$bootstrapForm->addText('field', 'Field');

		$form = new Form();
		$form->addText('field', 'Field');
		$form->setRenderer(clone $bootstrapForm->getRenderer());

		ob_start();

		try {
			$form->render();
			$html = (string) ob_get_contents();
		} finally {
			ob_end_clean();
		}

		$this->assertStringContainsString('name="field"', $html);
		$this->assertStringContainsString('class="form-group"', $html);
	}

	public function testGeneratesDataClass(): void
	{
		$form = new BootstrapForm();
		$form->addText('name', 'Name');
		$form->addCheckbox('agree', 'Agree');

		$dataClass = (new Blueprint())->generateDataClass($form);

		$this->assertStringContainsString('public string $name', $dataClass);
		$this->assertStringContainsString('public bool $agree', $dataClass);
	}

}
