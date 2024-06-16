<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home Page - DcodeMania')]
class HomePage extends Component
{
    public function render()
    {
        $brand = Brand::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();
        return view('livewire.home-page', [
            'brands' => $brand,
            'categories' => $categories,
        ]);
    }
}
