<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputField extends Component
{
    public string $name;
    public string $label;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name)
    {
        $this->label = $label;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-field');
    }
}
