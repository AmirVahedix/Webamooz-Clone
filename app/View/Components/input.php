<?php

namespace App\View\Components;

use Illuminate\View\Component;

class input extends Component
{
    public $type;
    public $name;
    public $placeholder;
    public $value;
    public $autocomplete;
    public $required;
    public $autofocus;
    public $class;
    public $readonly;
    public $ltr;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'text', $name, $placeholder = null, $value = null,
                                    $autocomplete = null, $required = null, $autofocus = null, $class = null,
                                    $readonly = null, $ltr = null)
    {
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->autocomplete = $autocomplete;
        $this->require = $required;
        $this->autofocus = $autofocus;
        $this->class = $class;
        $this->readonly = $readonly;
        $this->ltr = $ltr;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
