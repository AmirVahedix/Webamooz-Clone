<?php

namespace App\View\Components;

use Illuminate\View\Component;

class error extends Component
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function render()
    {
        return view('components.error');
    }
}
