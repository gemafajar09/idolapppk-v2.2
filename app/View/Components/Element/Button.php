<?php

namespace App\View\Components\Element;

use Illuminate\View\Component;

class Button extends Component
{
    public $type, $class, $name, $onclick;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $class, $name, $onclick)
    {
        $this->type = $type;
        $this->class = $class;
        $this->onclick = $onclick;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.button');
    }
}
