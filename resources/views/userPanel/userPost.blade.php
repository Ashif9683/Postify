<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <title>UserPost</title>
    <link rel="stylesheet" href="{{ asset('css/userPanel/myPost.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
</head>

<body>
    @include('userPanel.components.userNavbar')

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="content">
        <h1>My Posts</h1>
        <a href="{{ route('user.post.create') }}" id="addPost">Add Post</a>
    </div>

    <table class="table">

        <thead class="tableHead">
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody class="tableBody">
            @forelse($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a id="edit" href="{{ route('user.posts.edit', $post->id) }}">Edit</a>
                        <a id="del" href="{{ route('user.posts.delete', $post->id) }}">Delete</a>
                    </td>
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