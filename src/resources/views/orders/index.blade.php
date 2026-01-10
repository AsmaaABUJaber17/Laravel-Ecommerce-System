@extends('layouts.app')

@section('content')
<h2>Orders</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Status</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->total }}</td>
            <td>
                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">
                    View
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
