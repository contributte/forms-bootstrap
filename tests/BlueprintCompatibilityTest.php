<?php declare (strict_types = 1);

namespace Tests;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Nette\Forms\Blueprint;
use Nette\Forms\Form;

/**
 * Tests for compatibility with {formPrint} / Blueprint::latte() functionality.
 *
 * @see https://github.com/contributte/forms-bootstrap/issues/63
 */
class BlueprintCompatibilityTest extends BaseTest
{

	protected function setUp(): void
	{
		parent::setUp();
		// Reset to default Bootstrap version
		BootstrapForm::switchBootstrapVersion(BootstrapVersion::V4);
	}

	/**
	 * Test that Blueprint::generateLatte() works with BootstrapForm.
	 * This is the core functionality needed for {formPrint} macro.
	 */
	public function testBlueprintGenerateLatteWithBootstrapForm(): void
	{
		$form = new BootstrapForm();
		$form->setAction('/submit');
		$form->addText('name', 'Name')
			->setRequired();
		$form->addEmail('email', 'Email');
		$form->addTextArea('message', 'Message');
		$form->addSubmit('submit', 'Send');

		$blueprint = new Blueprint();
		$latte = $blueprint->generateLatte($form);

		// Verify the generated Latte contains expected elements
		$this->assertStringContainsString('{input name}', $latte);
		$this->assertStringContainsString('{input email}', $latte);
		$this->assertStringContainsString('{input message}', $latte);
		$this->assertStringContainsString('{input submit}', $latte);
		$this->assertStringContainsString('{label name/}', $latte);
		$this->assertStringContainsString('{label email/}', $latte);
		$this->assertStringContainsString('{label message/}', $latte);
	}

	/**
	 * Test Blueprint with BootstrapForm in vertical mode.
	 */
	public function testBlueprintWithVerticalMode(): void
	{
		$form = new BootstrapForm();
		$form->setRenderMode(RenderMode::VERTICAL_MODE);
		$form->addText('username', 'Username');
		$form->addPassword('password', 'Password');
		$form->addSubmit('login', 'Login');

		$blueprint = new Blueprint();
		$latte = $blueprint->generateLatte($form);

		$this->assertStringContainsString('{input username}', $latte);
		$this->assertStringContainsString('{input password}', $latte);
		$this->assertStringContainsString('{input login}', $latte);
	}

	/**
	 * Test Blueprint with BootstrapForm in side-by-side mode.
	 */
	public function testBlueprintWithSideBySideMode(): void
	{
		$form = new BootstrapForm();
		$form->setRenderMode(RenderMode::SIDE_BY_SIDE_MODE);
		$form->addText('firstName', 'First Name');
		$form->addText('lastName', 'Last Name');
		$form->addSubmit('save', 'Save');

		$blueprint = new Blueprint();
		$latte = $blueprint->generateLatte($form);

		$this->assertStringContainsString('{input firstName}', $latte);
		$this->assertStringContainsString('{input lastName}', $latte);
		$this->assertStringContainsString('{input save}', $latte);
	}

	/**
	 * Test Blueprint with BootstrapForm in inline mode.
	 */
	public function testBlueprintWithInlineMode(): void
	{
		$form = new BootstrapForm();
		$form->setRenderMode(RenderMode::INLINE);
		$form->addText('search', 'Search');
		$form->addSubmit('go', 'Go');

		$blueprint = new Blueprint();
		$latte = $blueprint->generateLatte($form);

		$this->assertStringContainsString('{input search}', $latte);
		$this->assertStringContainsString('{input go}', $latte);
	}

	/**
	 * Test Blueprint with BootstrapForm using Bootstrap 5.
	 */
	public function testBlueprintWithBootstrap5(): void
	{
		BootstrapForm::switchBootstrapVersion(BootstrapVersion::V5);

		$form = new BootstrapForm();
		$form->addText('name', 'Name');
		$form->addSelect('country', 'Country', ['us' => 'USA', 'uk' => 'UK']);
		$form->addSubmit('submit', 'Submit');

		$blueprint = new Blueprint();
		$latte = $blueprint->generateLatte($form);

		$this->assertStringContainsString('{input name}', $latte);
		$this->assertStringContainsString('{input country}', $latte);
		$this->assertStringContainsString('{input submit}', $latte);
	}

	/**
	 * Test that BootstrapRenderer can be attached to a regular Form.
	 * This is necessary for Blueprint::generateLatte() to work.
	 */
	public function testRendererCanAttachToRegularForm(): void
	{
		$renderer = new BootstrapRenderer();
		$form = new Form();
		$form->addText('test', 'Test');

		// Should not throw an exception
		$renderer->attachForm($form);

		// Should be able to render
		$html = $renderer->render($form);
		$this->assertIsString($html);
		$this->assertNotEmpty($html);
	}

	/**
	 * Test that BootstrapRenderer with validation disabled works with regular Form.
	 */
	public function testRendererWithRegularFormNoValidation(): void
	{
		$renderer = new BootstrapRenderer();
		$form = new Form();
		$form->addText('field', 'Field');
		$form->addSubmit('submit', 'Submit');

		$renderer->attachForm($form);
		$html = $renderer->render($form);

		$this->assertStringContainsString('form', $html);
		$this->assertStringContainsString('field', $html);
	}

	/**
	 * Test Blueprint with complex form containing various input types.
	 */
	public function testBlueprintWithVariousInputTypes(): void
	{
		$form = new BootstrapForm();
		$form->addText('text', 'Text');
		$form->addTextArea('textarea', 'TextArea');
		$form->addEmail('email', 'Email');
		$form->addPassword('password', 'Password');
		$form->addSelect('select', 'Select', ['a' => 'A', 'b' => 'B']);
		$form->addCheckbox('checkbox', 'Checkbox');
		$form->addRadioList('radio', 'Radio', ['x' => 'X', 'y' => 'Y']);
		$form->addUpload('upload', 'Upload');
		$form->addHidden('hidden', 'value');
		$form->addSubmit('submit', 'Submit');

		$blueprint = new Blueprint();
		$latte = $blueprint->generateLatte($form);

		$this->assertStringContainsString('{input text}', $latte);
		$this->assertStringContainsString('{input textarea}', $latte);
		$this->assertStringContainsString('{input email}', $latte);
		$this->assertStringContainsString('{input password}', $latte);
		$this->assertStringContainsString('{input select}', $latte);
		$this->assertStringContainsString('{input checkbox}', $latte);
		$this->assertStringContainsString('{input radio}', $latte);
		$this->assertStringContainsString('{input upload}', $latte);
		$this->assertStringContainsString('{input hidden}', $latte);
		$this->assertStringContainsString('{input submit}', $latte);
	}

	/**
	 * Test Blueprint with form groups.
	 */
	public function testBlueprintWithFormGroups(): void
	{
		$form = new BootstrapForm();

		$form->addGroup('Personal Info');
		$form->addText('firstName', 'First Name');
		$form->addText('lastName', 'Last Name');

		$form->addGroup('Contact');
		$form->addEmail('email', 'Email');
		$form->addText('phone', 'Phone');

		$form->addGroup();
		$form->addSubmit('submit', 'Submit');

		$blueprint = new Blueprint();
		$latte = $blueprint->generateLatte($form);

		$this->assertStringContainsString('{input firstName}', $latte);
		$this->assertStringContainsString('{input lastName}', $latte);
		$this->assertStringContainsString('{input email}', $latte);
		$this->assertStringContainsString('{input phone}', $latte);
	}

	/**
	 * Test that cloning BootstrapRenderer works for Blueprint.
	 */
	public function testClonedRendererWorksWithRegularForm(): void
	{
		$bootstrapForm = new BootstrapForm();
		$bootstrapForm->addText('test', 'Test');

		// Clone the renderer (as Blueprint does)
		$renderer = clone $bootstrapForm->getRenderer();

		// Create a regular form
		$regularForm = new Form();
		$regularForm->addText('test', 'Test');

		// Should be able to set the cloned renderer on regular form
		$regularForm->setRenderer($renderer);

		// Form::render() echoes output and returns void, so use output buffering
		ob_start();
		$regularForm->render();
		$html = ob_get_clean();

		$this->assertIsString($html);
		$this->assertNotEmpty($html);
	}

	/**
	 * Test isShowValidation returns false for non-BootstrapForm.
	 */
	public function testIsShowValidationReturnsFalseForRegularForm(): void
	{
		$renderer = new BootstrapRenderer();
		$form = new Form();
		$form->addText('test', 'Test');

		$renderer->attachForm($form);

		// Render should succeed without errors related to showValidation
		$html = $renderer->render($form);
		$this->assertIsString($html);
		// The validation CSS classes should not be present for valid fields
		// since isShowValidation returns false for non-BootstrapForm
		$this->assertStringNotContainsString('is-valid', $html);
	}

	/**
	 * Test Blueprint::dataClass works with BootstrapForm.
	 */
	public function testBlueprintGenerateDataClassWithBootstrapForm(): void
	{
		$form = new BootstrapForm();
		$form->addText('name', 'Name')
			->setRequired();
		$form->addEmail('email', 'Email');
		$form->addInteger('age', 'Age');
		$form->addCheckbox('newsletter', 'Subscribe to newsletter');

		$blueprint = new Blueprint();
		$dataClass = $blueprint->generateDataClass($form);

		// Verify the generated data class contains expected properties
		$this->assertStringContainsString('$name', $dataClass);
		$this->assertStringContainsString('$email', $dataClass);
		$this->assertStringContainsString('$age', $dataClass);
		$this->assertStringContainsString('$newsletter', $dataClass);
		$this->assertStringContainsString('class', $dataClass);
	}

}
