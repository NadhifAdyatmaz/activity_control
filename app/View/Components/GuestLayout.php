<?php

namespace App\View\Components;

use App\Models\Information;
use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $infos = Information::all();

        return view('layouts.guest',compact('infos'));
    }
}
