<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public $title;
    public $checked;
    public $value;
    public $name;

    public function __construct($title, $value, $name ,$checked = null)
    {
        $this->title = $title;
        $this->checked = $checked;
        $this->value = $value;
        $this->name = $name;
    }

    public function render()
    {
        return view('components.checkbox');
    }
}
