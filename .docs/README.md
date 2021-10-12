# Contributte / forms-bootstrap

## Examples
[See example here](https://codepen.io/czubehead/pen/ZryJQd?editors=1000)

## Features
- [Bootstrap 5 forms](https://getbootstrap.com/docs/5.1/forms/overview/) HTML generation
- [Bootstrap 4 forms](http://getbootstrap.com/docs/4.0/components/forms/) HTML generation
- All layout modes: vertical, side-by-side and inline
- TextInput placeholders
- Highly configurable renderer
- [Custom Bootstrap controls](http://getbootstrap.com/docs/4.0/components/forms/#custom-forms)
- Date(Time) picker, variety of human readable date/time formats, placeholder example generation
- [Validation styles](http://getbootstrap.com/docs/4.0/components/forms/#server-side)
- Programmatically generated [Bootstrap grid](https://getbootstrap.com/docs/4.1/layout/grid/)
- Assisted manual rendering
- BootstrapForm::$allwaysUseNullable to set all fields as nullable (calls $component->setNullable() for all fields automatically)

## Installation

The best way is via composer:

```bash
composer require contributte/forms-bootstrap
```

*Note that if you simply clone the main branch from this repo, it is not guaranteed to work, use releases instead*

### Requirements

- Works with `Nette\Application\UI\Form`, not `Nette\Forms\Form`, so you need the
  whole Nette framework.
- PHP 7.1+
- Client-side bootstrap 4 stylesheets and JS (obviously)

### Compatibility

This package is compatible with any version of Bootstrap 4 and 5

## How to use

### Form

Probably the main class you will be using is `Contributte\FormsBootstrap\BootstrapForm`.
It has all the features of this library pre-configured and extends
`Nette\Application\UI\Form` functionality by:
 - Only accepts `Contributte\FormsBootstrap\BootstrapRenderer` or its children (which is default)
 - Built-in AJAX support (adds `ajax` class upon rendering) via `ajax`(bool) property
 - Has direct access to render mode property of renderer (property `renderMode`)
 - All add* methods are overridden by bootstrap-enabled controls

```php
$form = new BootstrapForm;
$form->renderMode = RenderMode::Vertical;
```

It will behave pretty much the same as the default Nette form, with the exception of not grouping buttons.
That feature would only add unnecessary and deceiving overhead to this library,
**use grid instead, it will give you much finer control**

#### Render modes
 1. **Vertical** (`Enums\RenderMode::VERTICAL_MODE`) all controls are below their labels
 2. **Side-by-side** (`Enums\RenderMode::SIDE_BY_SIDE_MODE`) controls have their labels
 on the left. It is made up using [Bootstrap grid](http://v4-alpha.getbootstrap.com/layout/grid/).
 The default layout is 3 columns for labels and 9 for controls. This can be altered
 using `BootstrapRenderer::setColumns($label, $input)`.
 3. **Inline** `Enums\RenderMode::INLINE` all controls and labels will be in one
 enormous line

#### Bootstrap versions support
 1. **^4** (`Enums\BoostrapVersion::V4`) version 4 mode (default)
 2. **^5** (`Enums\BoostrapVersion::V5`) version 5 mode

```php
BootstrapForm::switchBootstrapVersion(Enums\BoostrapVersion::V5)
$form = new BootstrapForm;
```

### Controls / inputs

Each default control has has been extended bootstrap-enabled controls and
will render itself correctly even without the renderer. You can distinguish
them easily - they all have `Input` suffix.

#### TextInput

TextInput can have placeholder set (`$input->setPlaceholder($val)`). All text-based
inputs (except for TextArea) inherit from this control.

#### DateTimeInput

Its format can be set (`$input->setFormat($str)`), the default is d.m.yyyy h:mm
(though you must specify it in standard PHP format!).

You may use DateTimeFormats class constants as a list of pretty much all formats:
```php
DateTimeFormat::D_DMY_DOTS_NO_LEAD
```
is the default format for Date and
```php
DateTimeFormat::D_DMY_DOTS_NO_LEAD . ' ' . DateTimeFormat::T_24_NO_LEAD
```
is the default format for DateTime. You can also change this globally with
```php
DateInput::$defaultFormat = DateTimeFormat::D_DMY_DOTS_NO_LEAD;
DateTimeInput::$defaultFormat = DateTimeFormat::D_DMY_DOTS_NO_LEAD . ' ' . DateTimeFormat::T_24_NO_LEAD;
```

if U want to add html classes for those element so it's easy to connect it with any javascript date(time) picker use
```php
DateInput::$additionalHtmlClasses = 'datepicker';
DateTimeInput:$additionalHtmlClasses = 'datetimepicker';
```

See PhpDoc for further explanation.

#### UploadInput

Nothing out of ordinary, but it **Needs `<html lang="xx">` attribute** to work.

Has property `buttonCaption`, which sets the text on the button on the left.
The right button is set by [Bootstrap CSS](http://getbootstrap.com/docs/4.0/components/forms/#file-browser), which depends `<html lang="xx">`.

### Renderer

The renderer is enhanced by the following API:

|property|type|meaning|
|----|---|-----|
|mode|int constant|see render mode above in form section|
|gridBreakPoint|string / null|Bootstrap grid breakpoint for side-by-side view. Default is 'sm'|
|groupHidden| bool| if true, hidden fields will be grouped at the end. If false, hidden fields are placed where they were added. Default is true.|

### Grid

The library provides a way to programmatically place controls into Bootstrap grid and thus
greatly reduces the need for manual rendering.

Simply add a new row like this:
```php
$row = $form->addRow();
$row->addCell(6)
	->addText('firstname', 'First name');
$row->addCell(6)
	->addText('surname', 'Surname');
```

And firstname and surname will be beside each other.

#### Notes

- By calling `getElementPrototype()` on row or cell, you can influence the elements of row / cell
- A cell can only hold one control (or none)
- You are not limited to numerical column specification.
Also check out `\Contributte\FormsBootstrap\Grid\BootstrapCell::COLUMNS_NONE`
and `\Contributte\FormsBootstrap\Grid\BootstrapCell::COLUMNS_AUTO`

# Assisted manual rendering

Why do we use manual rendering? Mostly to just rearrange the inputs, we rarely
create a completely different feel.
But there is a hefty price for using manual rendering - we have to do almost everything
ourselves, even the things the renderer could do for us. Only if there were a way to
let the renderer do most of the work...

## What can it do

Assisted manual rendering will render label-input pairs for you using a filter.
This means that it will take care of wrapping things into `div.form-group` and validation
messages - the most mundane thing to implement in a template.

## Implementation

First of all, **you must implement this yourself, this won't work out of the box!**
The implementation is quite dirty, but I think the benefits outweigh this cost.

It works like this:
### 1. Implement a filter
add a new filter to your latte engine, for example:
```php
$this->template->addFilter('formPair', function ($control) {
	/** @var BootstrapRenderer $renderer */
	$renderer = $control->form->renderer;
	$renderer->attachForm($control->form);

	return $renderer->renderPair($control);
});
```
### 2. Use it
```php
{$form['firstname']|formPair|noescape}
```

That will result in
```html
<div class="form-group row">
    <label for="frm-form-firstname" class="col-sm-3">First name</label>

    <div class="col-sm-9">
        <input type="text" name="firstname" id="frm-form-firstname" class="form-control">
    </div>
</div>
```
