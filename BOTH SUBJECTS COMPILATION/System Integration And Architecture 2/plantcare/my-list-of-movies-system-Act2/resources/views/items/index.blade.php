@extends('layouts.app')

@section('content')

<h2>Movie List</h2>

@foreach($items as $item)

<div class="card">

    <h3>{{ $item['title'] }}</h3>

    <p><strong>Genre:</strong> {{ $item['genre'] }}</p>

    <p><strong>Year:</strong> {{ $item['year'] }}</p>

    <a href="/items/{{ $item['id'] }}">
        View Details
    </a>

</div>

@endforeach

@endsection