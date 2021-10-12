<?php declare (strict_types = 1);

namespace Tests;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Nette\Forms\Rendering\DefaultFormRenderer;

class BootstrapFormTest extends BaseTest
{

	public function testSetRendereWithWrongBootstrapRendererShouldThrowException(): void
	{
		$this->expectExceptionMessage('Renderer must be a BootstrapRenderer class');
		$form = new BootstrapForm();
		$form->setRenderer(new DefaultFormRenderer());
	}

	public function testGettersAndSetters(): void
	{
		$form = new BootstrapForm();
		$form->setAutoShowValidation(true);
		$this->assertTrue($form->isAutoShowValidation());

		$form->setAjax(true);
		$this->assertTrue($form->isAjax());

		$form->setRenderMode(RenderMode::SIDE_BY_SIDE_MODE);
		$this->assertEquals(RenderMode::SIDE_BY_SIDE_MODE, $form->getRenderMode());

		BootstrapForm::switchBootstrapVersion(BootstrapVersion::V5);
		$this->assertEquals(BootstrapVersion::V5, BootstrapForm::getBootstrapVersion());

		BootstrapForm::switchBootstrapVersion(BootstrapVersion::V4);
		$this->assertEquals(BootstrapVersion::V4, BootstrapForm::getBootstrapVersion());
	}

}
