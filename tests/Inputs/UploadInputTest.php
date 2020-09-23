<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Tests\BaseTest;

class UploadInputTest extends BaseTest
{

	public function testDefaultButton(): void
	{
		$form = new BootstrapForm();
		$btn = $form->addUpload('file', 'caption')->setButtonCaption('upload');
		$this->assertEquals('<div class="custom-file"><input type="file" name="file" id="frm-file" data-nette-rules=\'[{"op":":fileSize","msg":"The size of the uploaded file can be up to 2097152 bytes.","arg":2097152}]\' class="custom-file-input"><label class="custom-file-label" for="frm-file">upload</label></div>', $btn->getControl()->render());
	}

}
