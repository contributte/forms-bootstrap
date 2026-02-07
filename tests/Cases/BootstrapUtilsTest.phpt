<?php declare(strict_types = 1);

namespace Tests\Cases;

use Contributte\FormsBootstrap\BootstrapUtils;
use Contributte\Tester\Toolkit;
use Nette\Utils\Html;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

Toolkit::test(function (): void {
	$html = Html::el('div', ['class' => 'c1 c2']);
	BootstrapUtils::standardizeClass($html);
	Assert::equal(['c1', 'c2'], $html->class);
});
