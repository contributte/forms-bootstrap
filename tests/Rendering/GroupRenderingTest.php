<?php declare (strict_types = 1);

namespace Tests\Rendering;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\RendererOptions;
use Nette\Application\UI\Presenter;
use Nette\Utils\Html;
use Tests\BaseTest;

/**
 * Form groups: the renderer draws them before any loose controls and honours
 * the label, id and container options set on them.
 */
class GroupRenderingTest extends BaseTest
{

	private BootstrapForm $form;

	public function testGroupLabelIsRendered(): void
	{
		$group = $this->form->addGroup('Personal');
		$group->add($this->form->addText('name', 'Name'));

		$this->assertStringContainsString('Personal', $this->render());
	}

	/**
	 * An Html label keeps its attributes, but the configured element name wins,
	 * so it is always emitted as the <legend> of the group's fieldset.
	 */
	public function testHtmlGroupLabelIsRenamedToLegendButKeepsItsAttributes(): void
	{
		$group = $this->form->addGroup(null);
		$group->setOption(RendererOptions::LABEL, Html::el('h3', ['class' => 'fancy'])->setText('Personal'));
		$group->add($this->form->addText('name', 'Name'));

		$html = $this->render();

		$this->assertStringContainsString('<legend class="fancy">Personal</legend>', $html);
		$this->assertStringNotContainsString('<h3', $html);
	}

	public function testGroupIdEndsUpOnTheContainer(): void
	{
		$group = $this->form->addGroup('Personal');
		$group->setOption(RendererOptions::ID, 'personal-group');
		$group->add($this->form->addText('name', 'Name'));

		$this->assertStringContainsString('id="personal-group"', $this->render());
	}

	/**
	 * Same for the container: naming a different tag does not change it, the
	 * group is always drawn as a fieldset.
	 */
	public function testStringGroupContainerIsStillRenderedAsFieldset(): void
	{
		$group = $this->form->addGroup('Personal');
		$group->setOption(RendererOptions::CONTAINER, 'section');
		$group->add($this->form->addText('name', 'Name'));

		$html = $this->render();

		$this->assertStringContainsString('<fieldset>', $html);
		$this->assertStringNotContainsString('<section', $html);
	}

	public function testGroupContainerCanBeAnHtmlElement(): void
	{
		$group = $this->form->addGroup('Personal');
		$group->setOption(RendererOptions::CONTAINER, Html::el('section', ['class' => 'panel']));
		$group->add($this->form->addText('name', 'Name'));

		$this->assertStringContainsString('class="panel"', $this->render());
	}

	public function testNonVisualGroupIsSkipped(): void
	{
		$group = $this->form->addGroup('Hidden away');
		$group->setOption(RendererOptions::VISUAL, false);
		$group->add($this->form->addText('name', 'Name'));

		$html = $this->render();

		$this->assertStringNotContainsString('Hidden away', $html);
		// its controls are still drawn, just not inside a group container
		$this->assertStringContainsString('name="name"', $html);
	}

	public function testAnEmptyGroupIsSkipped(): void
	{
		$this->form->addGroup('Nothing here');
		// addGroup() makes the new group current, so step out of it before
		// adding a control that should stay loose
		$this->form->setCurrentGroup(null);
		$this->form->addText('name', 'Name');

		$html = $this->render();

		$this->assertStringNotContainsString('Nothing here', $html);
		$this->assertStringContainsString('name="name"', $html);
	}

	/**
	 * Groups are walked first so their controls get marked as rendered, but the
	 * markup is assembled the other way round: ungrouped controls are emitted
	 * first and the groups follow, whatever order they were added in.
	 */
	public function testUngroupedControlsAreRenderedBeforeGroups(): void
	{
		$group = $this->form->addGroup('Personal');
		$group->add($this->form->addText('grouped', 'Grouped'));
		$this->form->setCurrentGroup(null);
		$this->form->addText('loose', 'Loose');

		$html = $this->render();

		$this->assertLessThan(
			strpos($html, 'name="grouped"'),
			strpos($html, 'name="loose"')
		);
	}

	protected function setUp(): void
	{
		$this->form = new BootstrapForm();
		$this->form->setParent($this->createMock(Presenter::class));
		// A real (non-empty) action makes Nette inject the "_do" signal field,
		// mirroring production where the form is attached to a routed presenter.
		$this->form->setAction('/');
	}

	private function render(): string
	{
		ob_start();

		try {
			$this->form->render();

			return (string) ob_get_contents();
		} finally {
			ob_end_clean();
		}
	}

}
