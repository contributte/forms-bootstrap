<?php declare(strict_types = 1);

namespace Tests\Cases;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Contributte\Tester\Toolkit;
use Nette\Forms\Rendering\DefaultFormRenderer;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

Toolkit::test(function (): void {
	Assert::exception(function (): void {
		$form = new BootstrapForm();
		$form->setRenderer(new DefaultFormRenderer());
	}, \Throwable::class, 'Renderer must be a BootstrapRenderer class');
});

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$form->setAutoShowValidation(true);
	Assert::true($form->isAutoShowValidation());

	$form->setAjax(true);
	Assert::true($form->isAjax());

	$form->setRenderMode(RenderMode::SIDE_BY_SIDE_MODE);
	Assert::equal(RenderMode::SIDE_BY_SIDE_MODE, $form->getRenderMode());

	BootstrapForm::switchBootstrapVersion(BootstrapVersion::V5);
	Assert::equal(BootstrapVersion::V5, BootstrapForm::getBootstrapVersion());

	BootstrapForm::switchBootstrapVersion(BootstrapVersion::V4);
	Assert::equal(BootstrapVersion::V4, BootstrapForm::getBootstrapVersion());
});
