<?php

namespace App\View\Components\Element;

use Illuminate\View\Component;

class Input extends Component
{
    public $judul;
    public $type;
    public $name;
    public $place;
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($judul, $type, $name, $place, $value)
    {
        $this->judul = $judul;
        $this->type = $type;
        $this->name = $name;
        $this->place = $place;
        $this->ii = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.input');
    }
}
