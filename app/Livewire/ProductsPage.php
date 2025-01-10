<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Product - BatukelDev')]
class ProductsPage extends Component
{
    use LivewireAlert;
    use WithPagination;

    #[Url]
    public $select_categories = [];

    #[Url]
    public $select_brand = [];

    #[Url]
    public $featured;

    #[Url]
    public $on_sale;

    #[Url]
    public $price_range = 300000;

    #[Url]
    public $sort = 'latest';

    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        $this->alert('success', 'Product added to the cart successfully!', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }



    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);

        if (!empty($this->select_categories)) {
            $productQuery->whereIn('category_id', $this->select_categories);
        }
        if (!empty($this->select_brand)) {
            $productQuery->whereIn('brand_id', $this->select_brand);
        }

        if (!empty($this->select_brand)) {
            $productQuery->whereIn('brand_id', $this->select_brand);
        }

        if (!empty($this->featured)) {
            $productQuery->whereIn('is_featured', $this->featured);
        }

        if (!empty($this->on_sale)) {
            $productQuery->whereIn('on_sale', $this->on_sale);
        }

        if (!empty($this->price_range)) {
            $productQuery->whereBetween('price', [0, $this->price_range]);
        }

        if ($this->sort == 'latest') {
            $productQuery->latest();
        }

        if ($this->sort == 'price') {
            $productQuery->orderBy('price');
        }

        return view('livewire.products-page', [
            'products' => $productQuery->paginate(6),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
