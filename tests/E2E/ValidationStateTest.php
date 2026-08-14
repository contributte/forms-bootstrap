<?php declare (strict_types = 1);

namespace Tests\E2E;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\FormsBootstrap\Enums\RendererOptions;

/**
 * Submits a form that fails validation and then re-renders it, the way a
 * presenter does when it falls through to the template after onError.
 */
class ValidationStateTest extends BaseE2ETestCase
{

	public function testInvalidControlIsMarkedAndCarriesItsMessage(): void
	{
		$html = $this->renderToString($this->submitLoginForm(['name' => '', 'age' => '30']));

		$this->assertStringContainsString('is-invalid', $html);
		$this->assertStringContainsString('<div class="invalid-feedback">Name is required<br></div>', $html);
	}

	/**
	 * autoShowValidation is on by default, so a failed submit also paints the
	 * controls that did pass.
	 */
	public function testPassingControlsTurnValidOnFailedSubmit(): void
	{
		$form = $this->submitLoginForm(['name' => '', 'age' => '30']);

		$this->assertTrue($form->isShowValidation());

		$html = $this->renderToString($form);
		$this->assertStringContainsString('is-valid', $html);
	}

	public function testAutoShowValidationCanBeTurnedOff(): void
	{
		$form = $this->submitLoginForm(
			['name' => '', 'age' => '30'],
			fn (BootstrapForm $form) => $form->setAutoShowValidation(false)
		);

		$this->assertFalse($form->isShowValidation());

		$html = $this->renderToString($form);
		// the failing control is still flagged, the passing one is left alone
		$this->assertStringContainsString('is-invalid', $html);
		$this->assertStringNotContainsString('is-valid', $html);
	}

	public function testSuccessfulSubmitRendersNoValidationState(): void
	{
		$form = $this->submitLoginForm(['name' => 'Dalibor', 'age' => '30']);

		$this->assertTrue($form->isSuccess());

		$html = $this->renderToString($form);
		$this->assertStringNotContainsString('is-invalid', $html);
		$this->assertStringNotContainsString('is-valid', $html);
	}

	public function testValidFeedbackMessageIsRenderedWhenConfigured(): void
	{
		$form = $this->submitLoginForm(
			['name' => '', 'age' => '30'],
			function (BootstrapForm $form): void {
				$form['age']->setOption(RendererOptions::FEEDBACK_VALID, 'Age looks good');
			}
		);

		$html = $this->renderToString($form);
		$this->assertStringContainsString('<div class="valid-feedback">Age looks good<br></div>', $html);
	}

	/**
	 * UploadInput wraps its <input> in a <div>, so the state class has to land
	 * on the input itself rather than on the wrapper.
	 */
	public function testUploadInputMarksTheInnerInput(): void
	{
		$form = $this->submit(
			function (): BootstrapForm {
				$form = new BootstrapForm();
				$form->setAction('/');
				$form->addUpload('avatar', 'Avatar')->setButtonCaption('Choose')
					->setRequired('Avatar is required');
				$form->addSubmit('send');

				return $form;
			},
			[]
		);

		$this->assertFalse($form->isSuccess());

		$html = $this->renderToString($form);
		$this->assertStringContainsString('class="custom-file-input is-invalid"', $html);
	}

	public function testBootstrap5UsesTheSameStateClasses(): void
	{
		BootstrapForm::switchBootstrapVersion(BootstrapVersion::V5);

		try {
			$html = $this->renderToString($this->submitLoginForm(['name' => '', 'age' => '30']));

			$this->assertStringContainsString('is-invalid', $html);
			$this->assertStringContainsString('<div class="invalid-feedback">Name is required<br></div>', $html);
		} finally {
			BootstrapForm::switchBootstrapVersion(BootstrapVersion::V4);
		}
	}

	/**
	 * @param mixed[] $data
	 * @param callable(BootstrapForm): mixed|null $configure
	 */
	private function submitLoginForm(array $data, ?callable $configure = null): BootstrapForm
	{
		return $this->submit(
			function () use ($configure): BootstrapForm {
				$form = new BootstrapForm();
				$form->setAction('/');
				$form->addText('name', 'Name')->setRequired('Name is required');
				$form->addText('age', 'Age');
				$form->addSubmit('send', 'Send');

				if ($configure !== null) {
					$configure($form);
				}

				return $form;
			},
			$data
		);
	}

}
