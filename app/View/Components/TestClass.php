<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TestClass extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $classBase;
    public $datai;

    public function __construct($classBase, $datai="初期値")
    {
        $this->classBase = $classBase;
        $this->datai = $datai;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tests.test-class');
    }
}
