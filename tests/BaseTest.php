<?php declare (strict_types = 1);

namespace Tests;

use Heimkaup\Common\Utils\Strings;
use Nette\Reflection\ClassType;
use PHPUnit\Framework\TestCase;

abstract class BaseTest extends TestCase
{

	public function loadTextData(string $filename): string
	{
		return file_get_contents(__DIR__  . '/data/' . $filename);
	}
}
