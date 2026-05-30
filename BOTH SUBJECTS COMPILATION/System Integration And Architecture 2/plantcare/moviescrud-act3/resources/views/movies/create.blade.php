<!DOCTYPE html>
<html>
<head>
    <title>Add Movie</title>
</head>
<body>

<h1>Add Movie</h1>

<form action="{{ route('movies.store') }}" method="POST">
    @csrf

    <input type="text" name="title" placeholder="Title"><br><br>

    <input type="text" name="genre" placeholder="Genre"><br><br>

    <input type="number" name="year_release" placeholder="Year Release"><br><br>

    <input type="text" name="director" placeholder="Director"><br><br>

    <input type="text" name="rating" placeholder="Rating"><br><br>

    <button type="submit">Save</button>
</form>

<a href="{{ route('movies.index') }}">Back</a>

</body>
</html>