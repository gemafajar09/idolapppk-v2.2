<?php

namespace App\View\Components\Element;

use Illuminate\View\Component;

class Modal extends Component
{
    public $id;
    public $action;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id,$action)
    {
        $this->id = $id;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.modal');
    }
}
