<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="{{ asset('css/adminPanel/adminPanel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
</head>

<body>
    @include('adminPanel.components.adminNavbar')
    <h2>All Posts</h2>
    <table class="table">
        <thead class="tableHead">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody class="tableBody">
            @forelse($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td class="noData">No Posts Available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>