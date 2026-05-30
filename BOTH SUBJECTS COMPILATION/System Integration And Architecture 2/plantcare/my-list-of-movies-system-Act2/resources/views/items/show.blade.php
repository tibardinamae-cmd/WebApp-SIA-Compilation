@extends('layouts.app')

@section('content')

<div class="card">

    <h2>{{ $item['title'] }}</h2>

    <p><strong>Genre:</strong> {{ $item['genre'] }}</p>

    <p><strong>Year:</strong> {{ $item['year'] }}</p>

    <p><strong>Description:</strong></p>

    <p>{{ $item['description'] }}</p>

    <br>

    <a href="/items" class="btn">
        Back to List
    </a>

</div>

@endsection