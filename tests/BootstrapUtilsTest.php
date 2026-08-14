<?php declare (strict_types = 1);

namespace Tests;

use Contributte\FormsBootstrap\BootstrapUtils;
use Nette\Utils\Html;

class BootstrapUtilsTest extends BaseTestCase
{

	public function testStandardizeClass(): void
	{
		$html = Html::el('div', ['class' => 'c1 c2']);
		BootstrapUtils::standardizeClass($html);
		$this->assertEquals(['c1', 'c2'], $html->class);
	}

	public function testFetchClassesReadsEitherShapeOfTheAttribute(): void
	{
		$this->assertSame(['c1', 'c2'], BootstrapUtils::fetchClasses(Html::el('div', ['class' => 'c1 c2'])));
		$this->assertSame(['c1', 'c2'], BootstrapUtils::fetchClasses(Html::el('div', ['class' => ['c1', 'c2']])));
		$this->assertSame([], BootstrapUtils::fetchClasses(Html::el('div')));
	}

	public function testAddClassKeepsWhateverWasThere(): void
	{
		$html = Html::el('div', ['class' => 'c1 c2']);

		BootstrapUtils::addClass($html, 'c3');

		$this->assertSame('<div class="c1 c2 c3"></div>', (string) $html);
	}

	public function testAddClassOnElementWithoutOne(): void
	{
		$html = Html::el('div');

		BootstrapUtils::addClass($html, 'only');

		$this->assertSame('<div class="only"></div>', (string) $html);
	}

	public function testRemoveClassDropsOnlyTheNamedOne(): void
	{
		$html = Html::el('div', ['class' => 'keep drop']);

		BootstrapUtils::removeClass($html, 'drop');

		$this->assertSame('<div class="keep"></div>', (string) $html);
	}

	public function testRemoveClassThatIsNotThereChangesNothing(): void
	{
		$html = Html::el('div', ['class' => 'keep']);

		BootstrapUtils::removeClass($html, 'absent');

		$this->assertSame('<div class="keep"></div>', (string) $html);
	}

	public function testHasClass(): void
	{
		$html = Html::el('div', ['class' => 'c1 c2']);

		$this->assertTrue(BootstrapUtils::hasClass($html, 'c1'));
		$this->assertFalse(BootstrapUtils::hasClass($html, 'c3'));
	}

}
