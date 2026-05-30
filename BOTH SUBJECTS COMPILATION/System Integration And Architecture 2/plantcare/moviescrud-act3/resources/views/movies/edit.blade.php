<!DOCTYPE html>
<html>
<head>
    <title>Edit Movie</title>
</head>
<body>

<h1>Edit Movie</h1>

<form action="{{ route('movies.update', $movie->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $movie->title }}"><br><br>

    <input type="text" name="genre" value="{{ $movie->genre }}"><br><br>

    <input type="number" name="year_release" value="{{ $movie->year_release }}"><br><br>

    <input type="text" name="director" value="{{ $movie->director }}"><br><br>

    <input type="text" name="rating" value="{{ $movie->rating }}"><br><br>

    <button type="submit">Update</button>
</form>

<a href="{{ route('movies.index') }}">Back</a>

</body>
</html>