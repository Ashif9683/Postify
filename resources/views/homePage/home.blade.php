@include('homePage.components.homeNavbar')
<div class="content">
    <div>
        @forelse($posts as $post)
            <a href="{{ url('/post/' . $post->id) }}" class="post-link">
                <div class="post-container">
                    <div class="post-content">
                        <h1>{{  $post->title }}</h1>
                        <p>{{ $post->short_content }}</p>
                        <div class="date-author">
                            <span>{{ $post->formatted_date }}</span>
                            <span id="user-name">{{ $post->user->name }}</span>
                        </div>

                    </div>
                    <div class="post-image">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" width="300">
                        @else
                            <p>No Image Available</p>
                        @endif
                    </div>

                </div>
        @empty
                <div class="noData">
                    <p>No Posts Available</p>
                </div>
            @endforelse
    </div>

</div>
</body>

</html>