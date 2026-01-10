@extends('layouts.app')

@section('content')
<h3 class="mb-3">Reports</h3>

<div class="list-group">
    <a href="{{ url('/reports/raw') }}" class="list-group-item list-group-item-action">
        Raw SQL Report
    </a>
    <a href="{{ url('/reports/builder') }}" class="list-group-item list-group-item-action">
        Query Builder Report
    </a>
</div>
@endsection
