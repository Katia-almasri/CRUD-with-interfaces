<?php

namespace App\View\Components;

use Illuminate\View\Component;

class index extends Component
{
    public $post;
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.index');
    }
}
