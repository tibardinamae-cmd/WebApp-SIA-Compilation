<!DOCTYPE html>
<html>
<head>
    <title>Movie Details</title>
</head>
<body>

<h1>Movie Details</h1>

<p><strong>Title:</strong> {{ $movie->title }}</p>
<p><strong>Genre:</strong> {{ $movie->genre }}</p>
<p><strong>Year:</strong> {{ $movie->year_release }}</p>
<p><strong>Director:</strong> {{ $movie->director }}</p>
<p><strong>Rating:</strong> {{ $movie->rating }}</p>

<a href="{{ route('movies.index') }}">Back</a>

</body>
</html>