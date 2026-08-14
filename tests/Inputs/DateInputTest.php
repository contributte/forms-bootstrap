<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\DateTimeFormat;
use Contributte\FormsBootstrap\Inputs\DateInput;
use DateTime;
use Nette\Forms\Form;
use Tests\BaseTestCase;

class DateInputTest extends BaseTestCase
{

	// rule that DateInput adds in its constructor
	private const FORMAT_RULE = '[{"op":"Contributte\\\\FormsBootstrap\\\\Inputs\\\\DateInput::validateFormat","msg":"invalid/incorrect format"}]';

	public function testDefaultDate(): void
	{
		$form = new BootstrapForm();
		$dt = $form->addBootstrapDate('date', 'Date');
		$this->assertEquals('<input type="text" name="date" id="frm-date" data-nette-rules=\'' . self::FORMAT_RULE . '\' class="form-control" placeholder="d.m.yyyy (31.12.1998)">', $dt->getControl()->render());
	}

	public function testWithCustomStaticFormat(): void
	{
		$form = new BootstrapForm();
		DateInput::$defaultFormat = DateTimeFormat::D_YMD_DASHES;
		$dt = $form->addBootstrapDate('date', 'Date');
		$this->assertEquals('<input type="text" name="date" id="frm-date" data-nette-rules=\'' . self::FORMAT_RULE . '\' class="form-control" placeholder="yyyy-mm-dd (1998-12-31)">', $dt->getControl()->render());
	}

	/**
	 * @see https://github.com/contributte/forms-bootstrap/issues/61
	 */
	public function testConditionsAreExported(): void
	{
		$form = new BootstrapForm();
		$checkbox = $form->addCheckbox('agree', 'Agree');
		$date = $form->addBootstrapDate('date', 'Date');
		$date->addConditionOn($checkbox, Form::Equal, true)
			->setRequired('Date is required');
		$date->addCondition(Form::Filled)
			->addRule(Form::MinLength, 'Too short', 3);

		$rules = $date->getControl()->render();
		$this->assertStringContainsString(':equal', $rules);
		$this->assertStringContainsString(':filled', $rules);
		$this->assertStringContainsString(':minLength', $rules);
	}

	/**
	 * The format rule reads the control's value, which is a DateTime once the input
	 * has been validated. It used to hand that straight to a string parameter.
	 */
	public function testFormatRuleAcceptsAnAlreadyParsedValue(): void
	{
		$form = new BootstrapForm();
		$date = $form->addBootstrapDate('date', 'Date');
		$date->setValue(new DateTime());

		$this->assertInstanceOf(DateTime::class, $date->getValue());
		$this->assertTrue(DateInput::validateFormat($date));
	}

	public function testFormatRuleStillRejectsUnparseableText(): void
	{
		$form = new BootstrapForm();
		$date = $form->addBootstrapDate('date', 'Date');
		$date->setValue('not a date');

		$this->assertFalse(DateInput::validateFormat($date));
	}

	public function testNullValueHasNoFormatToReject(): void
	{
		$form = new BootstrapForm();
		$date = $form->addBootstrapDate('date', 'Date');
		$date->setNullable();
		$date->setValue(null);

		$this->assertNull($date->getValue());
		$this->assertTrue(DateInput::validateFormat($date));
	}

}
