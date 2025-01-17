<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Pet</title>
</head>
<body>

<h1>Add New Pet</h1>

@if($errors->any())
    <ul style="color: red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('pets.store') }}" method="POST">
    @csrf
    <label for="name">Pet Name:</label><br>
    <input type="text" id="name" name="name" value="{{ old('name') }}" required><br><br>

    <label for="status">Pet Status:</label><br>
    <select id="status" name="status" required>
        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
    </select><br><br>

    <button type="submit">Add Pet</button>
</form>

<br>
<a href="{{ route('pets.index') }}">Back to Pets List</a>

</body>
</html>
