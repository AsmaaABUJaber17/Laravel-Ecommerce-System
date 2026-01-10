@extends('layouts.app')

@section('content')
<h2>Builder Queries Report</h2>

@if(count($results))
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            @foreach(array_keys((array)$results[0]) as $key)
                <th>{{ $key }}</th>
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
@else
<p>No results found.</p>
@endif
@endsection
