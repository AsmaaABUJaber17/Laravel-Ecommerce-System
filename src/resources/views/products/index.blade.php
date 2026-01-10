@extends('layouts.app')

@section('content')
<h2 class="mb-3">Products</h2>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Price (with tax)</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr class="{{ $product->stock < 5 ? 'table-danger' : '' }}">
            <td>{{ $product->name }}</td>
            <td>{{ $product->price_with_tax }}</td>
            <td>{{ $product->stock }}</td>

            <td>
                

                {{-- Edit --}}
                <a href="{{ route('products.edit', $product->id) }}"
                   class="btn btn-sm btn-warning me-1">
                    Edit
                </a>

                {{-- Buy --}}
                <a href="{{ route('orders.create', $product->id) }}"
                   class="btn btn-sm btn-primary me-1">
                    Buy
                </a>

                {{-- Delete (اختياري) --}}
                <form action="{{ route('products.destroy', $product->id) }}"
                      method="POST"
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $products->links('pagination::bootstrap-5') }}
@endsection


\App\Models\Product::withTrashed()->where('stock', 0)->get();
