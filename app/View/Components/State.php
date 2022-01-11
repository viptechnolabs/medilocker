<?php

namespace App\View\Components;

use Illuminate\View\Component;

class State extends Component
{
    public $getStates;
    public $select_state;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($selectState)
    {
        $this->select_state = $selectState;
        $this->getStates = \App\Models\State::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.state');
    }
}
