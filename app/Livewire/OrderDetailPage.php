<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Order Detail')]
class OrderDetailPage extends Component
{

    public $order_id;
    public $model_order;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
        $this->model_order = Order::where('id', $this->order_id)->first();
        if (!$this->model_order) {
            redirect('/');
        }
    }

    public function render()
    {
        $order_items = OrderItem::with('product')->where('order_id', $this->order_id)->get();
        $address = Address::where('order_id', $this->order_id)->first();
        return view('livewire.order-detail-page', [
            'order_items' => $order_items,
            'address' => $address,
            'order' => $this->model_order,
        ]);
    }
}
