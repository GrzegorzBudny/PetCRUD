<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pets List</title>
</head>
<body>

<h1>Available Pets</h1>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<form method="GET" action="{{ route('pets.index') }}">
    <label for="status">Filter by Status:</label>
    <select name="status" id="status" onchange="this.form.submit()">
        <option value="available" {{ $selectedStatus == 'available' ? 'selected' : '' }}>Available</option>
        <option value="pending" {{ $selectedStatus == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="sold" {{ $selectedStatus == 'sold' ? 'selected' : '' }}>Sold</option>
    </select>
</form>

<a href="{{ route('pets.create') }}">Add New Pet</a>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pets as $pet)
            <tr>
                <td>{{ $pet['name'] ?? 'null' }}</td>
                <td>{{ ucfirst($pet['status'] ?? 'null') }}</td>
                <td>
                    <a href="{{ route('pets.show', $pet['id']) }}">View</a>
                    <a href="{{ route('pets.edit', $pet['id']) }}">Edit</a>
                    <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" style="text-align:center;">No pets available.</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
