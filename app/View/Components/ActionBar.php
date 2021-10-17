<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionBar extends Component
{
    public $menu;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menu = collect(config('action-bar'))->map(function ($item)
        {
            $item["active"] = request()->routeIs($item["route"]);

            return $item;
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.action-bar');
    }
}
