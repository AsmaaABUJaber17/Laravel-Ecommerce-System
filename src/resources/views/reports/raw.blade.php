@extends('layouts.app')

@section('title','Raw SQL Report')

@section('content')
<h4 class="mb-3">Raw SQL Report</h4>

<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            @foreach(array_keys((array)$results[0]) as $key)
                <th>{{ ucfirst($key) }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($results as $row)
        <tr>
            @foreach((array)$row as $value)
                <td>{{ $value }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
