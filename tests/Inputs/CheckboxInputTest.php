<?php declare (strict_types = 1);

namespace Tests\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Nette\Utils\Html;
use Tests\BaseTest;

class CheckboxInputTest extends BaseTest
{

	public function testHtmlCaption(): void
	{
		$form = new BootstrapForm();
		$control = $form->addCheckbox('confirm', Html::fromHtml('<span class="test">Confirm</span>'));
		$html = $control->getControl()->render();
		$expectedHtml = '<label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="confirm" id="frm-confirm" data-nette-rules="[]"><label class="custom-control-label" for="frm-confirm"><span class="test">Confirm</span></label></label>';
		$this->assertEquals($expectedHtml, $html);
	}

	public function testHtmlCaptionV5(): void
	{
		BootstrapForm::switchBootstrapVersion(BootstrapVersion::V5);

		$form = new BootstrapForm();
		$control = $form->addCheckbox('confirm', Html::fromHtml('<span class="test">Confirm</span>'));
		$html = $control->getControl()->render();
		$expectedHtml = '<label class="form-check"><input type="checkbox" class="form-check-input" name="confirm" id="frm-confirm" data-nette-rules="[]"><label class="form-check-label" for="frm-confirm"><span class="test">Confirm</span></label></label>';
		$this->assertEquals($expectedHtml, $html);

		BootstrapForm::switchBootstrapVersion(BootstrapVersion::V4);
	}

}
