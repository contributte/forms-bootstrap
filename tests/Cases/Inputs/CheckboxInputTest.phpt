<?php declare(strict_types = 1);

namespace Tests\Cases\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\Tester\Toolkit;
use Nette\Utils\Html;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$control = $form->addCheckbox('confirm', Html::fromHtml('<span class="test">Confirm</span>'));
	$html = $control->getControl()->render();
	$expectedHtml = '<label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="confirm" id="frm-confirm" data-nette-rules="[]"><label class="custom-control-label" for="frm-confirm"><span class="test">Confirm</span></label></label>';
	Assert::same($expectedHtml, $html);
});

Toolkit::test(function (): void {
	BootstrapForm::switchBootstrapVersion(BootstrapVersion::V5);

	$form = new BootstrapForm();
	$control = $form->addCheckbox('confirm', Html::fromHtml('<span class="test">Confirm</span>'));
	$html = $control->getControl()->render();
	$expectedHtml = '<label class="form-check"><input type="checkbox" class="form-check-input" name="confirm" id="frm-confirm" data-nette-rules="[]"><label class="form-check-label" for="frm-confirm"><span class="test">Confirm</span></label></label>';
	Assert::same($expectedHtml, $html);

	BootstrapForm::switchBootstrapVersion(BootstrapVersion::V4);
});
