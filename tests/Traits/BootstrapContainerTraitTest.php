<?php declare (strict_types = 1);

namespace Tests\Traits;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Inputs\DateTimeControl;
use Contributte\FormsBootstrap\Inputs\TextInput;
use Contributte\FormsBootstrap\Inputs\UploadInput;
use Tests\BaseTest;

/**
 * The add*() factories that BootstrapForm and BootstrapContainer share.
 */
class BootstrapContainerTraitTest extends BaseTest
{

	public function testAddDateTimeProducesDateTimeLocalInput(): void
	{
		$form = new BootstrapForm();
		$input = $form->addDateTime('when', 'When');

		$this->assertInstanceOf(DateTimeControl::class, $input);
		$this->assertStringContainsString('type="datetime-local"', (string) $input->getControl());
	}

	public function testAddTimeProducesTimeInput(): void
	{
		$form = new BootstrapForm();
		$input = $form->addTime('when', 'When');

		$this->assertInstanceOf(DateTimeControl::class, $input);
		$this->assertStringContainsString('type="time"', (string) $input->getControl());
	}

	public function testAddIntegerAcceptsWholeNumbersOnly(): void
	{
		$form = new BootstrapForm();
		$input = $form->addInteger('count', 'Count');

		$this->assertInstanceOf(TextInput::class, $input);
		$this->assertStringContainsString('type="number"', (string) $input->getControl());

		// the Integer rule casts the raw string once the control is validated
		$input->setValue('12');
		$input->validate();
		$this->assertSame(12, $input->getValue());
		$this->assertSame([], $input->getErrors());
	}

	public function testAddIntegerRejectsNonWholeNumber(): void
	{
		$form = new BootstrapForm();
		$input = $form->addInteger('count', 'Count');

		$input->setValue('abc');
		$input->validate();

		$this->assertCount(1, $input->getErrors());
	}

	public function testAddFloatAcceptsDecimals(): void
	{
		$form = new BootstrapForm();
		$input = $form->addFloat('ratio', 'Ratio');

		$this->assertInstanceOf(TextInput::class, $input);
		$this->assertStringContainsString('step="any"', (string) $input->getControl());

		$input->setValue('1.5');
		$input->validate();
		$this->assertSame(1.5, $input->getValue());
	}

	public function testAddPasswordHidesWhatIsTyped(): void
	{
		$form = new BootstrapForm();
		$input = $form->addPassword('secret', 'Secret');

		$this->assertStringContainsString('type="password"', (string) $input->getControl());
		$this->assertStringContainsString('form-control', (string) $input->getControl());
	}

	public function testAddMultiUploadTakesSeveralFiles(): void
	{
		$form = new BootstrapForm();
		$input = $form->addMultiUpload('files', 'Files');

		$this->assertInstanceOf(UploadInput::class, $input);

		$input->setButtonCaption('Pick');
		$html = (string) $input->getControl();
		$this->assertStringContainsString('multiple', $html);
		$this->assertStringContainsString('type="file"', $html);
	}

	public function testAddInputErrorAttachesTheErrorToTheNamedControl(): void
	{
		$form = new BootstrapForm();
		$form->addText('name', 'Name');

		$form->addInputError('name', 'that name is taken');

		$this->assertSame(['that name is taken'], $form['name']->getErrors());
		$this->assertTrue($form->hasErrors());
	}

	public function testAddColorProducesColorInput(): void
	{
		$form = new BootstrapForm();
		$input = $form->addColor('shade', 'Shade');

		$this->assertStringContainsString('type="color"', (string) $input->getControl());
	}

	public function testAddButtonIsNotSubmitter(): void
	{
		$form = new BootstrapForm();
		$button = $form->addButton('go', 'Go');

		$html = (string) $button->getControl();
		$this->assertStringContainsString('btn', $html);
		$this->assertStringNotContainsString('type="submit"', $html);
	}

	public function testFactoriesAlsoWorkInsideContainer(): void
	{
		$form = new BootstrapForm();
		$container = $form->addContainer('nested');
		$container->addPassword('secret', 'Secret');
		$container->addInteger('count', 'Count');

		$this->assertStringContainsString('type="password"', (string) $container['secret']->getControl());
		$this->assertStringContainsString('name="nested[count]"', (string) $container['count']->getControl());
	}

}
