<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="{{ asset('css/adminPanel/adminPanel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
</head>

<body>
    @include('adminPanel.components.adminNavbar');
    <table class="table">
        <thead class="tableHead">
            <tr>
                <th>Users</th>
                <th>Author</th>
                <th>Post Count</th>
                <th>Added On</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody class="tableBody">
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->posts_count }}</td>
                    <td>{{ $user->created_at->format('d M Y')  }}</td>
                    <td><a id="del" href="{{ route('admin.user.delete',$user->id) }}">Delete</a></td>
                </tr>

            @empty
                <tr>
                    <td class="noData">No Users Available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>