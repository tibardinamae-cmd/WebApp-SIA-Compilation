<!DOCTYPE html>
<html>
<head>
    <title>Movies List</title>
</head>
<body>

<h1>Movies List</h1>

<a href="{{ route('movies.create') }}">Add Movie</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>Title</th>
        <th>Genre</th>
        <th>Actions</th>
    </tr>

    @foreach($movies as $movie)
    <tr>
        <td>{{ $movie->title }}</td>
        <td>{{ $movie->genre }}</td>
        <td>
            <a href="{{ route('movies.show', $movie->id) }}">View</a>
            <a href="{{ route('movies.edit', $movie->id) }}">Edit</a>

            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

</body>
</html>