<?php declare(strict_types = 1);

namespace Tests\Cases\Inputs;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\Tester\Toolkit;
use Nette\InvalidArgumentException;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$items = ['Croatia', 'Czech', 'Iceland', 'Sweeden'];
	$select = $form->addSelect('country', 'Country')->setItems($items, false);
	Assert::true(array_key_exists('Croatia', $select->getItems()));
});

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$items = ['Croatia', 'Czech', 'Iceland', 'Sweeden'];
	$select = $form->addSelect('country', 'Country')->setItems($items, true);
	Assert::false(array_key_exists('Croatia', $select->getItems()));
});

Toolkit::test(function (): void {
	$countries = [
		'A' => ['B', 'C'],
		'D' => [2 => 'E', 'F'],
	];

	$form = new BootstrapForm();
	$select = $form->addSelect('test', 'test')->setItems($countries, true);
	$html = $select->getControl()->render();
	$expectedHtml = '<select name="test" id="frm-test" class="custom-select"><optgroup label="A"><option value="0">B</option><option value="1">C</option></optgroup><optgroup label="D"><option value="2">E</option><option value="3">F</option></optgroup></select>';
	Assert::same($expectedHtml, $html);
});

Toolkit::test(function (): void {
	BootstrapForm::switchBootstrapVersion(BootstrapVersion::V5);

	$countries = [
		'A' => ['B', 'C'],
		'D' => [2 => 'E', 'F'],
	];

	$form = new BootstrapForm();
	$select = $form->addSelect('test', 'test')->setItems($countries, true);
	$html = $select->getControl()->render();
	$expectedHtml = '<select name="test" id="frm-test" class="form-select"><optgroup label="A"><option value="0">B</option><option value="1">C</option></optgroup><optgroup label="D"><option value="2">E</option><option value="3">F</option></optgroup></select>';
	Assert::same($expectedHtml, $html);

	BootstrapForm::switchBootstrapVersion(BootstrapVersion::V4);
});

Toolkit::test(function (): void {
	Assert::exception(function (): void {
		$form = new BootstrapForm();
		$select = $form->addSelect('test', 'test', [null => 'choose']);
		$select->setPrompt('Hey');
	}, InvalidArgumentException::class);
});

Toolkit::test(function (): void {
	$form = new BootstrapForm();
	$select = $form->addSelect('test', 'test', ['1' => 'First', '2' => 'Second']);
	$select->setPrompt('');
	$select->setPrompt('Choose');
	$html = $select->getControl()->render();

	Assert::contains('Choose', $html);
});
