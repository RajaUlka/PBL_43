<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
</head>
<body>
    <h1>User Information</h1>
    
    @if ($user)
        <p>Name: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Role: {{ $user->role }}</p>
    @else
        <p>User not found.</p>
    @endif
</body>
</html>
