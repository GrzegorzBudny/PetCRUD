<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Details</title>
</head>
<body>

<h1>Pet Details</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<p><strong>Name:</strong> {{ $pet['name'] ?? 'Null' }}</p>
<p><strong>Status:</strong> {{ ucfirst($pet['status'] ?? 'Null') }}</p>

<a href="{{ route('pets.index') }}">Back to Pets List</a>

</body>
</html>
