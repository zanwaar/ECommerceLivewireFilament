<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        $total = Order::query()->avg('grand_total');
        if (!$total) {
        $total = 0;
        }
        return [
            Stat::make('New Orders', Order::query()->where('status', 'new')->count()),
            Stat::make('New Processing', Order::query()->where('status', 'processing')->count()),
            Stat::make('New Sipped', Order::query()->where('status', 'shipped')->count()),

            Stat::make('Average Price', Number::currency($total, 'INR')),
        ];
    }
}
