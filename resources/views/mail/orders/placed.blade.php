<x-mail::message>
# Order placed successfully

Thank you for order. Your order Number is: {{ $order->id }}

<x-mail::button :url="$url">
    Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>