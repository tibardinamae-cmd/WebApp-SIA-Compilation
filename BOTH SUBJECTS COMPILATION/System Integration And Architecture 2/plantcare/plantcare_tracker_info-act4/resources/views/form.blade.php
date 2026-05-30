<!DOCTYPE html>
<html>
<head>
    <title>🌱 Plant Care Input Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
    <h2 class="mb-4">🌿 Add Plant Care Record</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/form">
        @csrf

        <div class="mb-3">
            <label>Plant Name</label>
            <input type="text" name="plant_name" class="form-control" value="{{ old('plant_name') }}">
            @error('plant_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Owner Email</label>
            <input type="email" name="owner_email" class="form-control" value="{{ old('owner_email') }}">
            @error('owner_email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Plant Age (months)</label>
            <input type="number" name="plant_age" class="form-control" value="{{ old('plant_age') }}">
            @error('plant_age')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Sunlight Requirement</label>
            <select name="sunlight" class="form-control">
                <option value="">Select</option>
                <option value="Full Sun" {{ old('sunlight')=='Full Sun' ? 'selected' : '' }}>Full Sun</option>
                <option value="Partial Shade" {{ old('sunlight')=='Partial Shade' ? 'selected' : '' }}>Partial Shade</option>
                <option value="Low Light" {{ old('sunlight')=='Low Light' ? 'selected' : '' }}>Low Light</option>
            </select>
            @error('sunlight')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Care Notes</label>
            <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
            @error('notes')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-success">Submit 🌿</button>

    </form>
</div>

</body>
</html>