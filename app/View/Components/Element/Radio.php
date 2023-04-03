<?php

namespace App\View\Components\Element;

use Illuminate\View\Component;

class Radio extends Component
{
    public $array, $judul;
    public function __construct($array, $judul)
    {
        $this->array = $array;
        $this->judul = $judul;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.element.radio');
    }
}
