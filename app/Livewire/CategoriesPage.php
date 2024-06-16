<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoriesPage extends Component
{
    public function render()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('livewire.categories-page', [
            'categories' => $categories,
        ]);
    }
}
