# Bootstrap 4 forms for Nette

**Please use English in potential issues, let's keep it clean, shall we?**

This is a library that lets you use Bootstrap 4 forms in 
[Nette framework](http://nette.org). 

Rather than being just a renderer, this introduces a custom set of controls 
(which covers all default controls) and a renderer.

Note that **this is an alpha**, so it may be buggy. That is where you can 
help by reporting issues.

[See example here](https://codepen.io/czubehead/pen/ZryJQd?editors=1000)

## Features

- Fully valid [Bootstrap 4 forms](http://getbootstrap.com/docs/4.0/components/forms/) HTML generation
- All layout modes: vertical, side-by-side and inline
- TextInput placeholders
- Highly configurable renderer
- [Custom Bootstrap controls](http://getbootstrap.com/docs/4.0/components/forms/#custom-forms)
- DateTime picker, variety of human readable date/time formats, placeholder example generation
- [Validation styles](http://getbootstrap.com/docs/4.0/components/forms/#server-side)
- Programmatically generated [Bootstrap grid](https://getbootstrap.com/docs/4.1/layout/grid/)
 
## Installation

The best way is via composer:

```cmd
composer require czubehead/bootstrap-4-forms
```

*Note that if you simply clone the main branch from this repo, it is not guaranteed to work, use releases instead*

### Requirements

- Works with `Nette\Application\UI\Form`, not `Nette\Forms\Form`, so you need the
  whole Nette framework.
- PHP 5.6+
- Client-side bootstrap 4 stylesheets and JS (obviously)

### Compatibility

This package is compatible with any version version of Bootstrap 4 
(last tested on v4.0.0-beta.2)

## How to use

### Form

Probably the main class you will be using is `Czubehead\BootstrapForms\BootstrapForm`.
It has all the features of this library pre-configured and extends 
`Nette\Application\UI\Form` functionality by:
 - Only accepts `Czubehead\BootstrapForms\BootstrapRenderer` or its children (which is default)
 - Built-in AJAX support (adds `ajax` class upon rendering) via `ajax`(bool) property
 - Has direct access to render mode property of renderer (property `renderMode`)
 - All add* methods are overridden by bootstrap-enabled controls

```php
$form = new BootstrapForm;
$form->renderMode = RenderMode::Vertical;		
```

It will behave pretty much the same as the default Nette form

#### Render modes
 1. **Vertical** (`Enums\RenderMode::VerticalMode`) all controls are below their labels
 2. **Side-by-side** (`Enums\RenderMode::SideBySideMode`) controls have their labels
 on the left. It is made up using [Bootstrap grid](http://v4-alpha.getbootstrap.com/layout/grid/).
 The default layout is 3 columns for labels and 9 for controls. This can be altered
 using `BootstrapRenderer::setColumns($label, $input)`.
 3. **Inline** `Enums\RenderMode::Inline` all controls and labels will be in one
 enormous line

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
DateTimeFormat::D_DMY_DOTS_NO_LEAD . ' ' . DateTimeFormat::T_24_NO_LEAD
```
is the default format for DateTime. See its PhpDoc for further explanation.

#### UploadInput

Nothing out of ordinary, but it **Needs `<html lang="xx">` attribute** to work.

Has property `buttonCaption`, which sets the text on the button on the left. 
The right button is set by [Bootstrap CSS](http://getbootstrap.com/docs/4.0/components/forms/#file-browser), which depends `<html lang="xx">`.

#### SelectInput, MultiSelectInput

These can accept nested arrays of options.

```php
[
    'sub' => [
        1 => 'opt1',
        2 => 'opt2'
    ],
    3     => 'opt3',
]
```
will generate
```html
<optgroup label="sub">
    <option value="1">opt1</option>
    <option value="2">opt2</option>
</optgroup>
<option value="3">opt3</option>
```

### Renderer

The renderer is enhanced by the following API:

|property|meaning|
|----|-----|
|mode|see render mode above in form section|
|gridBreakPoint|Bootstrap grid breakpoint for side-by-side view. Default is 'sm'|
|groupInlineInputs|If *consecutive* inline elements, such as buttons should be grouped together. For list of elements, see `Czubehead\BootstrapForms\Enums\RendererConfig::inlineClasses`. Does not apply in grid cells|

### Grid

*This may be buggy*

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

- It is recommended to use grid with vertical mode, side-by-side looks weird and probably is buggy
- By calling `getElementPrototype()` on row or cell, you can influence the elements of row / cell
- A cell can only hold one control (or none)
- If your grid system does not have 12 columns, you may adjust it by setting property 
`Czubehead\BootstrapForms\Grid\BootstrapRow::$numOfColumns`

------

- Made by [czubehead](https://petrcech.eu)
- [Componette link](https://componette.com/czubehead/bootstrap-4-forms/)
- [Packagist link](https://packagist.org/packages/czubehead/bootstrap-4-forms)
