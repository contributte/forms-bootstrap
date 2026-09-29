<?php declare (strict_types = 1);

namespace Tests\Rendering;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\BootstrapRenderer;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Nette\Application\UI\Presenter;
use Nette\HtmlStringable;
use Nette\Localization\Translator;
use PHPUnit\Framework\Attributes\DataProvider;
use Stringable;
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
			'text with stringable description' => [
			'vertical/text_description.html',
			function (BootstrapForm $form): void {
				$form->addText('a', 'b')->setOption('description', self::createMessage('Helpful hint'));
			}],
			'text with translated stringable description' => [
			'vertical/text_description_translated.html',
			function (BootstrapForm $form): void {
				$form->setTranslator(self::createTranslator());
				$form->addText('a', 'b')->setOption('description', self::createMessage('Helpful hint'));
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

	public function testStringableDescriptionIsEscaped(): void
	{
		$this->form->addText('a', 'b')->setOption('description', self::createMessage('<b>x</b>'));

		$html = $this->render();

		$this->assertStringContainsString('&lt;b&gt;x&lt;/b&gt;', $html);
		$this->assertStringNotContainsString('<b>x</b>', $html);
	}

	/**
	 * Translation message parameters are often user input
	 */
	public function testTranslatedStringableDescriptionIsEscaped(): void
	{
		$this->form->setTranslator(self::createTranslator());
		$this->form->addText('a', 'b')->setOption('description', self::createMessage('Hello %name%', ['%name%' => '<img src=x onerror=alert(1)>']));

		$html = $this->render();

		$this->assertStringContainsString('[Hello &lt;img src=x onerror=alert(1)&gt;]', $html);
		$this->assertStringNotContainsString('<img', $html);
	}

	public function testEmptyStringableDescriptionIsNotRendered(): void
	{
		$this->form->addText('a', 'b')->setOption('description', self::createMessage(''));

		$this->assertStringNotContainsString('<small', $this->render());
	}

	public function testHtmlStringableDescriptionIsRenderedRaw(): void
	{
		$this->form->addText('a', 'b')->setOption('description', new class implements HtmlStringable {

			public function __toString(): string
			{
				return '<b>x</b>';
			}

		});

		$this->assertStringContainsString('<small class="form-text text-muted"><b>x</b></small>', $this->render());
	}

	protected function setUp(): void
	{
		$this->form = new BootstrapForm();
		$this->form->setRenderer(new BootstrapRenderer(RenderMode::VERTICAL_MODE));
		$this->form->setParent($this->createStub(Presenter::class));
		// A real (non-empty) action makes Nette inject the "_do" signal field,
		// mirroring production where the form is attached to a routed presenter.
		$this->form->setAction('/');
	}

	/**
	 * Stand-in for translation wrappers such as Contributte\Translation\Wrappers\Message
	 *
	 * @param array<string, string> $parameters
	 */
	private static function createMessage(string $message, array $parameters = []): Stringable
	{
		return new class ($message, $parameters) implements Stringable {

			/**
			 * @param array<string, string> $parameters
			 */
			public function __construct(public string $message, public array $parameters)
			{
			}

			public function __toString(): string
			{
				return $this->message;
			}

		};
	}

	/**
	 * Wraps the result in [] and fills in the parameters of messages from createMessage()
	 */
	private static function createTranslator(): Translator
	{
		return new class implements Translator {

			public function translate(string|Stringable $message, mixed ...$parameters): string
			{
				$params = $message instanceof Stringable && property_exists($message, 'parameters') ? $message->parameters : [];

				return '[' . strtr((string) $message, $params) . ']';
			}

		};
	}

	private function render(): string
	{
		ob_start();

		try {
			$this->form->render();

			return (string) ob_get_contents();
		} finally {
			ob_end_clean();
		}
	}

}
