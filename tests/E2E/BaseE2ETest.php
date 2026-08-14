<?php declare (strict_types = 1);

namespace Tests\E2E;

use Contributte\FormsBootstrap\BootstrapForm;
use Nette\Application\Request as AppRequest;
use Nette\Http;
use ReflectionMethod;
use Tests\BaseTest;

/**
 * Base for end-to-end tests: builds a real HTTP request, runs a real presenter
 * through its whole lifecycle and lets the form receive the `submit` signal
 * exactly the way it does in production.
 */
abstract class BaseE2ETest extends BaseTest
{

	/**
	 * Signal that submits a form named `form` sitting directly on the presenter.
	 */
	protected const FORM_SIGNAL = 'form-submit';

	protected TestPresenter $presenter;

	/**
	 * Submits $data to the form built by $formFactory and returns the form
	 * after the request has been handled.
	 *
	 * @param callable(): BootstrapForm $formFactory
	 * @param mixed[] $data payload of the request, without the signal field
	 * @param array<string, Http\FileUpload> $files
	 */
	protected function submit(
		callable $formFactory,
		array $data,
		array $files = [],
		string $method = 'POST'
	): BootstrapForm
	{
		$isPost = strcasecmp($method, 'POST') === 0;

		// the `_do` hidden field the renderer emits for POST forms, `do` in the query for GET ones
		$post = $isPost ? $data + ['_do' => self::FORM_SIGNAL] : [];
		$query = $isPost ? [] : $data + ['do' => self::FORM_SIGNAL];

		$httpRequest = new Http\Request(
			new Http\UrlScript('http://localhost/index.php?' . http_build_query($query)),
			post: $post,
			files: $files,
			// marks the request as same-site so Nette's CSRF check lets the signal through
			cookies: [Http\Helpers::StrictCookieName => '1'],
			headers: [],
			method: $isPost ? 'POST' : 'GET',
		);

		$this->presenter = new TestPresenter();
		$this->presenter->formFactory = $formFactory;
		$this->injectHttp($this->presenter, $httpRequest, new Http\Response());
		// canonicalization would need a router, and it is not what these tests are about
		$this->presenter->autoCanonicalize = false;

		$this->presenter->run(new AppRequest(
			'Test',
			$isPost ? 'POST' : 'GET',
			['action' => 'default'] + $query,
			$post,
			$files,
		));

		/** @var BootstrapForm $form */
		$form = $this->presenter->getComponent('form');

		return $form;
	}

	/**
	 * Renders a form to a string the same way a template would.
	 */
	protected function renderToString(BootstrapForm $form): string
	{
		ob_start();

		try {
			$form->render();

			return (string) ob_get_contents();
		} finally {
			ob_end_clean();
		}
	}

	/**
	 * Hands the presenter its HTTP request and response.
	 *
	 * Presenter::injectPrimary() takes every collaborator a presenter can have and
	 * its parameter order differs across the nette/application versions this library
	 * supports, so the arguments are matched up by name and everything we do not
	 * need (DI container, presenter factory, router, session, user, template
	 * factory) is left null.
	 */
	private function injectHttp(TestPresenter $presenter, Http\IRequest $request, Http\IResponse $response): void
	{
		$args = [];

		foreach ((new ReflectionMethod($presenter, 'injectPrimary'))->getParameters() as $parameter) {
			$args[] = match ($parameter->getName()) {
				'httpRequest' => $request,
				'httpResponse' => $response,
				default => null,
			};
		}

		$presenter->injectPrimary(...$args);
	}

}
