<?php declare(strict_types = 1);

namespace Tests\Cases\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\Tester\Toolkit;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$btn = $form->addUpload('file', 'caption')->setButtonCaption('upload');
	Assert::same('<div class="custom-file"><input type="file" name="file" id="frm-file" data-nette-rules=\'[{"op":":fileSize","msg":"The size of the uploaded file can be up to 2097152 bytes.","arg":2097152}]\' class="custom-file-input"><label class="custom-file-label" for="frm-file">upload</label></div>', $btn->getControl()->render());
});

Toolkit::test(function (): void {
	BootstrapForm::switchBootstrapVersion(BootstrapVersion::V5);

	$form = new BootstrapForm();
	$btn = $form->addUpload('file', 'caption')->setButtonCaption('upload');
	Assert::same('<div><input type="file" name="file" id="frm-file" data-nette-rules=\'[{"op":":fileSize","msg":"The size of the uploaded file can be up to 2097152 bytes.","arg":2097152}]\' class="form-control"><label class="form-label" for="frm-file">upload</label></div>', $btn->getControl()->render());

	BootstrapForm::switchBootstrapVersion(BootstrapVersion::V4);
});
