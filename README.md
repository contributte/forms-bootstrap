# Bootstrap 4 forms for Nette

This is a library that lets you use Bootstrap 4 forms in 
[Nette framework](http://nette.org). 

Rather than being just a renderer, this introduces a custom set of controls 
(which covers all default controls) and a renderer.

Note that **this is an early alpha**, so it may be buggy. That is where you can 
help by reporting issues.

## Features

- Fully valid [Bootstrap 4 forms](http://v4-alpha.getbootstrap.com/components/forms/) HTML generation
- All layout modes: vertical, side-by-side and inline
- TextInput placeholders
- Mostly just extends vanilla functionality, so all features should be preserved
- DateTime picker, variety of human readable date/time formats

### What is missing (but is planned)

*This is where you can help by contributing*

 - Multilingual support
 - More configurability
 
## Installation

The best way is via composer:

```cmd
composer require czubehead/bootstrap-4-forms
```

### Requirements

- Works with `Nette\Application\UI\Form`, not `Nette\Forms\Form`, so you need the
  whole Nette framework.
- PHP 5.6+
- Client-side bootstrap 4 stylesheets and JS (obviously)

## How to use

### Form

Probably the main class you will be using is `Czubehead\BootstrapForms\BootstrapForm`.
It has all the features of this library pre-configured and extends 
`Nette\Application\UI\Form` functionality by:
 - Only accepts `Czubehead\BootstrapForms\BootstrapRenderer` (which is default)
 - Built-in AJAX support (adds `ajax` class upon rendering) via `ajax`(bool) property
 - Has direct access to render mode property of renderer
 - All add* methods are overridden by bootstrap-enabled controls
 - Can change autocomplete on/off on all controls

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

---

Made by [czubehead](https://petrcech.eu)