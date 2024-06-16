<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('My Orders')]
class MyOrderPage extends Component
{
    use WithPagination;

    public function render()
    {
        $my_orders = Order::where('user_id', auth()->user()->id)->latest()->paginate(10);
        return view('livewire.my-order-page', [
            'orders' => $my_orders,
        ]);
    }
}
