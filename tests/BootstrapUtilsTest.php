<?php declare (strict_types = 1);

namespace Tests;

use Contributte\FormsBootstrap\BootstrapUtils;
use Nette\Utils\Html;

class BootstrapUtilsTest extends BaseTest
{

	public function testStandardizeClass(): void
	{
		$html = Html::el('div', ['class' => 'c1 c2']);
		BootstrapUtils::standardizeClass($html);
		$this->assertEquals(['c1', 'c2'], $html->class);
	}

}
