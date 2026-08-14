<?php declare (strict_types = 1);

namespace Tests\E2E;

use Contributte\FormsBootstrap\BootstrapForm;
use Nette\Http\FileUpload;

/**
 * Drives whole requests through a real presenter: a form is rendered, a browser
 * posts it back and the resulting values, errors and events are checked.
 */
class FormSubmissionTest extends BaseE2ETestCase
{

	public function testValidSubmitIsSuccessfulAndYieldsValues(): void
	{
		$form = $this->submit(
			fn (): BootstrapForm => $this->contactForm(),
			['name' => 'Dalibor', 'email' => 'dalibor@example.com']
		);

		$this->assertTrue($form->isSuccess());
		$this->assertSame([], $form->getErrors());
		$this->assertSame(
			['name' => 'Dalibor', 'email' => 'dalibor@example.com'],
			(array) $form->getValues()
		);
	}

	public function testOnSuccessHandlerReceivesSubmittedValues(): void
	{
		$this->submit(
			fn (): BootstrapForm => $this->contactForm(),
			['name' => 'Dalibor', 'email' => 'dalibor@example.com']
		);

		$this->assertSame(
			['name' => 'Dalibor', 'email' => 'dalibor@example.com'],
			$this->presenter->succeededWith
		);
		$this->assertFalse($this->presenter->errored);
	}

	public function testMissingRequiredValueFailsValidation(): void
	{
		$form = $this->submit(
			fn (): BootstrapForm => $this->contactForm(),
			['name' => '', 'email' => 'dalibor@example.com']
		);

		$this->assertTrue((bool) $form->isSubmitted());
		$this->assertFalse($form->isSuccess());
		$this->assertSame(['Name is required'], $form->getErrors());
		$this->assertNull($this->presenter->succeededWith);
		$this->assertTrue($this->presenter->errored);
	}

	/**
	 * addEmail() wires up the Email rule on its own, so a malformed address is
	 * rejected without the caller adding any rule.
	 */
	public function testAddEmailValidatesTheAddressByItself(): void
	{
		$form = $this->submit(
			fn (): BootstrapForm => $this->contactForm(),
			['name' => 'Dalibor', 'email' => 'not-an-email']
		);

		$this->assertFalse($form->isSuccess());
		$this->assertCount(1, $form['email']->getErrors());
	}

	public function testFailingRuleReportsItsOwnMessage(): void
	{
		$form = $this->submit(
			function (): BootstrapForm {
				$form = new BootstrapForm();
				$form->setAction('/');
				$form->addText('nick', 'Nick')->addRule(BootstrapForm::MinLength, 'Nick is too short', 5);
				$form->addSubmit('send');

				return $form;
			},
			['nick' => 'abc']
		);

		$this->assertFalse($form->isSuccess());
		$this->assertSame(['Nick is too short'], $form->getErrors());
		$this->assertSame(['Nick is too short'], $form['nick']->getErrors());
	}

	public function testRequestWithoutSignalIsNotSubmitted(): void
	{
		$form = $this->submit(
			fn (): BootstrapForm => $this->contactForm(),
			// a plain page view: the fields happen to be in the query, but no signal was sent
			['name' => 'Dalibor', 'email' => 'dalibor@example.com'],
			[],
			'GET'
		);

		$this->assertFalse((bool) $form->isSubmitted());
		$this->assertFalse($form->isSuccess());
	}

	public function testGetFormRoundTripsThroughTheQueryString(): void
	{
		$form = $this->submit(
			function (): BootstrapForm {
				$form = $this->contactForm();
				$form->setMethod('get');

				return $form;
			},
			['name' => 'Dalibor', 'email' => 'dalibor@example.com'],
			[],
			'GET'
		);

		$this->assertTrue($form->isSuccess());
		$this->assertSame(
			['name' => 'Dalibor', 'email' => 'dalibor@example.com'],
			(array) $form->getValues()
		);
	}

	public function testValuesRoundTripThroughContainers(): void
	{
		$form = $this->submit(
			function (): BootstrapForm {
				$form = new BootstrapForm();
				$form->setAction('/');
				$address = $form->addContainer('address');
				$address->addText('street')->setRequired('Street is required');
				$address->addText('city');
				$form->addSubmit('send');

				return $form;
			},
			['address' => ['street' => 'Ilica', 'city' => 'Zagreb']]
		);

		$this->assertTrue($form->isSuccess());
		$this->assertSame(
			['address' => ['street' => 'Ilica', 'city' => 'Zagreb']],
			$this->toArray($form->getValues())
		);
	}

	public function testValuesRoundTripThroughGridCells(): void
	{
		$form = $this->submit(
			function (): BootstrapForm {
				$form = new BootstrapForm();
				$form->setAction('/');
				$row = $form->addRow();
				$row->addCell(6)->addText('name');
				$row->addCell(6)->addText('mail');
				$form->addSubmit('send');

				return $form;
			},
			['name' => 'Dalibor', 'mail' => 'dalibor@example.com']
		);

		$this->assertTrue($form->isSuccess());
		// grid rows and cells are layout-only, so the values stay flat on the form
		$this->assertSame(
			['name' => 'Dalibor', 'mail' => 'dalibor@example.com'],
			$this->toArray($form->getValues())
		);
	}

	public function testSubmitButtonIsReportedAsTheSubmitter(): void
	{
		$form = $this->submit(
			fn (): BootstrapForm => $this->contactForm(),
			['name' => 'Dalibor', 'email' => 'dalibor@example.com', 'send' => 'Send']
		);

		$submitter = $form->isSubmitted();
		$this->assertSame($form['send'], $submitter);
	}

	public function testUploadedFileArrivesAsFileUpload(): void
	{
		$tmp = (string) tempnam(sys_get_temp_dir(), 'formsbootstrap');
		file_put_contents($tmp, 'hello');

		try {
			$form = $this->submit(
				function (): BootstrapForm {
					$form = new BootstrapForm();
					$form->setAction('/');
					$form->addUpload('avatar', 'Avatar')->setButtonCaption('Choose');
					$form->addSubmit('send');

					return $form;
				},
				[],
				[
					'avatar' => new FileUpload([
						'name' => 'avatar.txt',
						'size' => 5,
						'tmp_name' => $tmp,
						'error' => UPLOAD_ERR_OK,
					]),
				]
			);

			$this->assertTrue($form->isSuccess());

			/** @var FileUpload $upload */
			$upload = $form->getValues()->avatar;
			$this->assertInstanceOf(FileUpload::class, $upload);
			$this->assertTrue($upload->isOk());
			$this->assertSame('avatar.txt', $upload->getUntrustedName());
			$this->assertSame(5, $upload->getSize());
		} finally {
			@unlink($tmp);
		}
	}

	/**
	 * Values submitted for a control that was never offered must not be accepted.
	 */
	public function testSelectRejectsValueThatIsNotAmongItems(): void
	{
		$form = $this->submit(
			fn (): BootstrapForm => $this->countryForm(),
			['country' => 'xx']
		);

		$this->assertNull($form['country']->getValue());
	}

	public function testSelectAcceptsAnOfferedValue(): void
	{
		$form = $this->submit(
			fn (): BootstrapForm => $this->countryForm(),
			['country' => 'hr']
		);

		$this->assertTrue($form->isSuccess());
		$this->assertSame('hr', $form['country']->getValue());
	}

	public function testDisabledChoiceValueIsRejected(): void
	{
		$form = $this->submit(
			function (): BootstrapForm {
				$form = $this->countryForm();
				$form['country']->setDisabled(['cz']);

				return $form;
			},
			['country' => 'cz']
		);

		// the item was rendered disabled, so a forged post of it must not stick
		$this->assertNull($form['country']->getValue());
	}

	public function testWhollyDisabledRadioListIsRenderedDisabledAndRejectsItsPost(): void
	{
		$form = $this->submit(
			function (): BootstrapForm {
				$form = new BootstrapForm();
				$form->setAction('/');
				$form->addRadioList('size', 'Size', ['s' => 'Small', 'l' => 'Large'])
					->setDisabled(true);
				$form->addSubmit('send');

				return $form;
			},
			['size' => 's']
		);

		$this->assertNull($form['size']->getValue());
		$this->assertStringContainsString('<fieldset disabled>', (string) $form['size']->getControl());
	}

	public function testCheckboxListCollectsEveryCheckedValue(): void
	{
		$form = $this->submit(
			function (): BootstrapForm {
				$form = new BootstrapForm();
				$form->setAction('/');
				$form->addCheckboxList('langs', 'Languages', ['php' => 'PHP', 'js' => 'JS', 'go' => 'Go']);
				$form->addSubmit('send');

				return $form;
			},
			['langs' => ['php', 'go']]
		);

		$this->assertTrue($form->isSuccess());
		$this->assertSame(['php', 'go'], $form['langs']->getValue());
	}

	private function contactForm(): BootstrapForm
	{
		$form = new BootstrapForm();
		$form->setAction('/');
		$form->addText('name', 'Name')->setRequired('Name is required');
		$form->addEmail('email', 'Email')->setRequired('Email is required');
		$form->addSubmit('send', 'Send');

		return $form;
	}

	private function countryForm(): BootstrapForm
	{
		$form = new BootstrapForm();
		$form->setAction('/');
		$form->addSelect('country', 'Country', ['hr' => 'Croatia', 'cz' => 'Czechia']);
		$form->addSubmit('send');

		return $form;
	}

	/**
	 * @param object $values
	 * @return mixed[]
	 */
	private function toArray($values): array
	{
		return json_decode((string) json_encode($values), true);
	}

}
