<?php declare(strict_types = 1);

namespace Tests\Cases\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\Tester\Toolkit;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$items = [2020 => 2020, 2021 => 2021];
	$control = $form->addCheckboxList('numbers', 'numbers', $items);
	$html = $control->getControl()->render();
	$expectedHtml = '<fieldset><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="numbers[]" id="frm-numbers0" data-nette-rules="[]" value="2020"><label class="custom-control-label" for="frm-numbers0">2020</label></label><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="numbers[]" id="frm-numbers1" data-nette-rules="[]" value="2021"><label class="custom-control-label" for="frm-numbers1">2021</label></label></fieldset>';
	Assert::same($expectedHtml, $html);
});

Toolkit::test(function (): void {
	BootstrapForm::switchBootstrapVersion(BootstrapVersion::V5);

	$form = new BootstrapForm();
	$items = [2020 => 2020, 2021 => 2021];
	$control = $form->addCheckboxList('numbers', 'numbers', $items);
	$html = $control->getControl()->render();
	$expectedHtml = '<fieldset><label class="form-check"><input type="checkbox" class="form-check-input" name="numbers[]" id="frm-numbers0" data-nette-rules="[]" value="2020"><label class="form-check-label" for="frm-numbers0">2020</label></label><label class="form-check"><input type="checkbox" class="form-check-input" name="numbers[]" id="frm-numbers1" data-nette-rules="[]" value="2021"><label class="form-check-label" for="frm-numbers1">2021</label></label></fieldset>';
	Assert::same($expectedHtml, $html);

	BootstrapForm::switchBootstrapVersion(BootstrapVersion::V4);
});
