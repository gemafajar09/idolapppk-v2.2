<?php

namespace App\View\Components\Element;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $judul;
    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($judul, $name)
    {
        $this->judul = $judul;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.textarea');
    }
}
