<?php

namespace Modules\Trader\Livewire\Blog;

use Livewire\Component;

class Blog extends Component
{
    public function render()
    {
        return view('trader::livewire.blog.blog')->extends('trader::components.layouts.app');
    }
}
