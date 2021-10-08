<?php

namespace App\View\Components;

use Illuminate\View\Component;

class input extends Component
{
    public $type;
    public $name;
    public $placeholder;
    public $autocomplete;
    public $required;
    public $autofocus;
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'text', $name, $placeholder = null, $autocomplete = null, $required = null, $autofocus = null, $class = null)
    {
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->autocomplete = $autocomplete;
        $this->require = $required;
        $this->autofocus = $autofocus;
        $this->class = $class;
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
