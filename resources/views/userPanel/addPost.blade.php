<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserPost</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/userPanel/myPost.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userPanel/addPost.css') }}">
</head>

<body>
    @include('userPanel.components.userNavbar')

    <form action="{{ isset($post) ? route('user.posts.update', $post->id) : route('user.posts.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if(isset($post))
            @method('PUT')
        @endif

        <div class="form-wrapper">

            <!-- Post Title -->
            <div class="form-group">
                <label for="postTitle">Post Title</label>
                <input type="text" id="postTitle" name="postTitle" placeholder="Latest Insights in Tech"
                    value="{{ old('postTitle', $post->title ?? '') }}">
                @error('postTitle')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image Upload -->
            <div class="form-group">
                <label for="postImage">Upload Image</label>
                <div class="image-upload-box">
                    <input type="file" name="image" id="postImage" accept="image/*">

                    @if (!isset($post))
                        <p id="uploadHint">Upload Image<br><span>1000 × 400 (in px)</span></p>
                    @endif

                    <span id="fileNameDisplay"></span>

                    @if (isset($post) && $post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Uploaded Image" width="300">
                    @endif
                </div>


                @error('image')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="postContent">Post Content</label>
                <textarea name="content" id="postContent" placeholder="Type or paste your content here!"
                    rows="10">{{ old('content', $post->content ?? '') }}</textarea>
                @error('content')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="submit-btn">{{ isset($post) ? 'Update Post' : 'Save Post' }}</button>
            </div>

        </div>
    </form>


    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.replace('postContent');
        } else {
            console.error("CKEditor not loaded");
        }

        document.getElementById('postImage').addEventListener('change', function () {
            const fileInput = this;
            const fileName = fileInput.files.length > 0 ? fileInput.files[0].name : '';
            const display = document.getElementById('fileNameDisplay');
            const hint = document.getElementById('uploadHint');

            display.textContent = fileName;

            if (hint) {
                hint.style.display = fileName ? 'none' : 'block';
            }
        });

    </script>

</body>

</html>