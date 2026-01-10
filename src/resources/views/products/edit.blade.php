@extends('layouts.app')

@section('content')
<h2>Edit Product</h2>

<form method="POST" action="{{ route('products.update', $product->id) }}">
    @csrf
    @method('PUT')

    {{-- Product Name --}}
    <div class="mb-2">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control"
               value="{{ old('name', $product->name) }}" required>
    </div>

    {{-- Price --}}
    <div class="mb-2">
        <label class="form-label">Price</label>
        <input type="number" step="0.01" name="price" class="form-control"
               value="{{ old('price', $product->price) }}" required>
    </div>

    {{-- Stock --}}
    <div class="mb-2">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" class="form-control"
               value="{{ old('stock', $product->stock) }}" required>
    </div>

    {{-- Category --}}
    <div class="mb-2">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-control" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Tags --}}
    <div class="mb-3">
        <label class="form-label"><strong>Tags</strong></label><br>
        @foreach($tags as $tag)
            <label class="me-3">
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                    {{ $product->tags->contains($tag->id) ? 'checked' : '' }}>
                {{ $tag->name }}
            </label>
        @endforeach
    </div>

    <button class="btn btn-success">Update Product</button>
</form>
@endsection
