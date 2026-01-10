@extends('layouts.app')

@section('content')
<h2>Add Product</h2>

<form method="POST" action="{{ route('products.store') }}">
    @csrf

    <input type="text" name="name" class="form-control mb-2" placeholder="Product Name">

    <input type="number" name="price" class="form-control mb-2" placeholder="Price">

    <input type="number" name="stock" class="form-control mb-2" placeholder="Stock">

    <select name="category_id" class="form-control mb-2">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <div class="mb-3">
        <strong>Tags:</strong><br>
        @foreach($tags as $tag)
            <label>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                {{ $tag->name }}
            </label><br>
        @endforeach
    </div>

    <button class="btn btn-primary">Save</button>
</form>
@endsection
