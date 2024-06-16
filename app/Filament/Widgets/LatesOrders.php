<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatesOrders extends BaseWidget
{
    protected int | string | array $columnSpan = "full";
    protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Order ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('grand_total')
                    ->money('INR'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped' => 'success',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'new' => 'heroicon-m-sparkles',
                        'processing' => 'heroicon-m-arrow-path',
                        'shipped' => 'heroicon-m-truck',
                        'delivered' => 'heroicon-m-check-badge',
                        'cancelled' => 'heroicon-m-x-circle',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_status')
                    ->sortable()
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Order Date')
                    ->dateTime(),
            ])->actions([
                Action::make('View Order')
                    ->url(fn (Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                    ->color('info')
                    ->icon('heroicon-o-eye'),
            ]);
    }
}
