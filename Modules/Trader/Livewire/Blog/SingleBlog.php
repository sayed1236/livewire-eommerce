<?php

namespace Modules\Trader\Livewire\Blog;

use Livewire\Component;

class SingleBlog extends Component
{
    public function render()
    {
        return view('trader::livewire.blog.single-blog')->extends('trader::components.layouts.app');
    }
}
