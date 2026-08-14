<?php declare (strict_types = 1);

namespace Tests\Traits;

use Contributte\FormsBootstrap\BootstrapForm;
use Nette\Utils\Html;
use Tests\BaseTestCase;

/**
 * The disabled/selected logic shared by radio, checkbox-list and select,
 * observed through the HTML those controls render.
 */
class ChoiceInputTraitTest extends BaseTestCase
{

	/**
	 * Known gap: RadioInput::getControl() only ever asks isValueDisabled() per
	 * item and never calls isControlDisabled(), so a radio list disabled as a
	 * whole still renders as interactive. CheckboxListInput and SelectInput both
	 * put the attribute on their element. Pinned here so that fixing RadioInput
	 * shows up as a failure of this test rather than going unnoticed.
	 */
	public function testDisablingTheWholeRadioListIsNotReflectedInTheHtml(): void
	{
		$form = new BootstrapForm();
		$radio = $form->addRadioList('a', 'b', ['x' => 'X', 'y' => 'Y']);
		$radio->setDisabled(true);

		$this->assertStringNotContainsString('disabled', (string) $radio->getControl());
	}

	public function testDisablingRadioListClearsWhateverWasSelected(): void
	{
		$form = new BootstrapForm();
		$radio = $form->addRadioList('a', 'b', ['x' => 'X', 'y' => 'Y']);
		$radio->setValue('x');

		$radio->setDisabled(true);

		$this->assertNull($radio->getValue());
	}

	public function testValueDisabledOneByOneIsNotReturned(): void
	{
		$form = new BootstrapForm();
		$radio = $form->addRadioList('a', 'b', ['x' => 'X', 'y' => 'Y']);
		$radio->setValue('x');

		$radio->setDisabled(['x']);

		$this->assertNull($radio->getValue());
	}

	public function testDisablingSingleValueLeavesOthersAlone(): void
	{
		$form = new BootstrapForm();
		$radio = $form->addRadioList('a', 'b', ['x' => 'X', 'y' => 'Y']);
		$radio->setDisabled(['x']);

		$html = (string) $radio->getControl();

		$this->assertSame(1, substr_count($html, 'disabled'));
		// the disabled one is x, so the input carrying value="x" is the disabled one
		$this->assertMatchesRegularExpression('#<input[^>]*value="x"[^>]*disabled#', $html);
	}

	public function testSelectedRadioValueIsChecked(): void
	{
		$form = new BootstrapForm();
		$radio = $form->addRadioList('a', 'b', ['x' => 'X', 'y' => 'Y']);
		$radio->setDefaultValue('y');

		$html = (string) $radio->getControl();

		$this->assertMatchesRegularExpression('#<input[^>]*value="y"[^>]*checked#', $html);
		$this->assertDoesNotMatchRegularExpression('#<input[^>]*value="x"[^>]*checked#', $html);
	}

	public function testNothingIsCheckedWithoutDefaultValue(): void
	{
		$form = new BootstrapForm();
		$radio = $form->addRadioList('a', 'b', ['x' => 'X', 'y' => 'Y']);

		$this->assertStringNotContainsString('checked', (string) $radio->getControl());
	}

	public function testWholeSelectIsDisabled(): void
	{
		$form = new BootstrapForm();
		$select = $form->addSelect('a', 'b', ['x' => 'X']);
		$select->setDisabled(true);

		$this->assertStringContainsString('disabled', (string) $select->getControl());
	}

	public function testWholeCheckboxListIsDisabledThroughItsFieldset(): void
	{
		$form = new BootstrapForm();
		$list = $form->addCheckboxList('a', 'b', ['x' => 'X', 'y' => 'Y']);
		$list->setDisabled(true);

		$html = (string) $list->getControl();

		// one attribute on the fieldset disables every checkbox inside it
		$this->assertStringStartsWith('<fieldset disabled>', $html);
		$this->assertSame(1, substr_count($html, 'disabled'));
	}

	public function testWholeMultiselectIsDisabled(): void
	{
		$form = new BootstrapForm();
		$multi = $form->addMultiSelect('a', 'b', ['x' => 'X']);
		$multi->setDisabled(true);

		$this->assertStringContainsString('disabled', (string) $multi->getControl());
	}

	public function testRadioListShowsInvalidStateOnEveryOption(): void
	{
		$form = new BootstrapForm();
		$radio = $form->addRadioList('a', 'b', ['x' => 'X', 'y' => 'Y']);
		$radio->addError('nope');

		$html = (string) $radio->showValidation($radio->getControl());

		$this->assertSame(2, substr_count($html, 'is-invalid'));
	}

	public function testCheckboxListShowsInvalidStateOnEveryOption(): void
	{
		$form = new BootstrapForm();
		$list = $form->addCheckboxList('a', 'b', ['x' => 'X', 'y' => 'Y']);
		$list->addError('nope');

		$html = (string) $list->showValidation($list->getControl());

		$this->assertSame(2, substr_count($html, 'is-invalid'));
	}

	public function testCheckboxListShowsValidStateWhenThereAreNoErrors(): void
	{
		$form = new BootstrapForm();
		$list = $form->addCheckboxList('a', 'b', ['x' => 'X']);

		$html = (string) $list->showValidation($list->getControl());

		$this->assertStringContainsString('is-valid', $html);
		$this->assertStringNotContainsString('is-invalid', $html);
	}

	public function testCheckboxShowsInvalidStateOnItsInput(): void
	{
		$form = new BootstrapForm();
		$checkbox = $form->addCheckbox('a', 'b');
		$checkbox->addError('nope');

		/** @var Html $control */
		$control = $checkbox->getControl();
		$html = (string) $checkbox->showValidation($control);

		$this->assertStringContainsString('is-invalid', $html);
	}

}
