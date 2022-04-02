<?php

namespace App\View\Components;

use Illuminate\View\Component;

class input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $label; 
    public $type;
    public $name;
    public function __construct($label,$type,$name)
    {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
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
