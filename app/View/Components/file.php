<?php

namespace App\View\Components;

use Illuminate\View\Component;

class file extends Component
{
    public $name;
    public $label;

    public function __construct($name, $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

    public function render()
    {
        return view('components.file');
    }
}
