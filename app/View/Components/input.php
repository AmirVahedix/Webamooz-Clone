<?php

namespace App\View\Components;

use Illuminate\View\Component;

class input extends Component
{
    public $name;
    public $placeholder;
    public $autocomplete;
    public $required;
    public $autofocus;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $placeholder = null, $autocomplete = null, $required = null, $autofocus = null)
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->autocomplete = $autocomplete;
        $this->require = $required;
        $this->autofocus = $autofocus;
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
