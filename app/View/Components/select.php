<?php

namespace App\View\Components;

use Illuminate\View\Component;

class select extends Component
{
    public $name;
    public $required;

    public function __construct($name, $required = null)
    {
        $this->name = $name;
        $this->required = $required;
    }

    public function render()
    {
        return view('components.select');
    }
}
