<?php declare(strict_types = 1);

namespace Tests\Cases\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\Tester\Toolkit;
use Nette\Utils\Html;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$input = $form->addTextArea('txt', 'lbl', 5, 10);
	$input->setAutocomplete(false);
	Assert::false($input->getAutocomplete());
	Assert::same('<textarea name="txt" cols="5" rows="10" id="frm-txt" class="form-control" autocomplete="off"></textarea>', $input->getControl()->render());
	Assert::same('<label for="frm-txt">lbl</label>', (string) $input->getLabel());
});

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$input = $form->addTextArea('txt', Html::el('strong')->setText('test'));
	Assert::same('<label for="frm-txt"><strong>test</strong></label>', (string) $input->getLabel());
});
