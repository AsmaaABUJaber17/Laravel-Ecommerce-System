@extends('layouts.app')

@section('content')
<h2>Order Details</h2>

<p>Status: {{ $order->status }}</p>
<p>Total: {{ $order->total }}</p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Unit Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->orderItems as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->unit_price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
