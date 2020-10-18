<?php

namespace Support\View\Components\Form;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Field extends Component
{
    public string $id;

    public string $type;
    public string $name;
    public ?string $value = null;
    public ?string $label = null;
    public ?string $placeholder = null;
    public ?string $autocomplete = null;
    public ?string $class = null;
    public bool $required = false;
    public bool $autofocus = false;

    public function __construct(
        string $type,
        string $name,
        string $value = null,
        string $label = null,
        string $placeholder = null,
        string $autocomplete = null,
        string $class = null,
        bool $required = false,
        bool $autofocus = false
    ) {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->autocomplete = $autocomplete;
        $this->class = $class;
        $this->required = $required;
        $this->autofocus = $autofocus;

        $this->id = hash('crc32b', Str::random());
    }

    public function computedValue()
    {
        if ($value = old($this->name)) {
            return $value;
        }

        return $this->value;
    }

    public function computedLabel()
    {
        if ($this->label) {
            return $this->label;
        }

        if ($this->placeholder) {
            return $this->placeholder;
        }

        return ucfirst($this->name);
    }

    public function computedPlaceholder()
    {
        if ($this->placeholder) {
            return $this->placeholder;
        }

        if ($this->label) {
            return $this->label;
        }

        return ucfirst($this->name);
    }

    public function computedClass()
    {
        $class = [$this->class];

        return $class;
    }

    public function render()
    {
        return view('components.form.field');
    }
}
