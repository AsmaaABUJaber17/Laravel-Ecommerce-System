@extends('layouts.app')

@section('content')
<h2>Purchase Product</h2>

<p><strong>Product:</strong> {{ $product->name }}</p>
<p><strong>Price:</strong> {{ $product->price }}</p>

<form method="POST" action="{{ route('orders.store') }}">
    @csrf

    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <label>Quantity</label>
    <input type="number" name="quantity" class="form-control mb-2">

    <button class="btn btn-primary">Confirm Order</button>
</form>
@endsection
