<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $imgFront;

    /**
     * Create a new component instance.
     *
     * @param string $imgFront
     * @return void
     */
    public function __construct($imgFront)
    {
        $this->imgFront = $imgFront;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card');
    }
}
