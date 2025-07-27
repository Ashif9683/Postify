@include('homePage.components.homeNavbar')


<div class="post-page-card">
    <div class="post-page-title">{{ $post->title }}</div>

    @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="post-page-image">
    @endif

    <div class="post-page-meta">
        <span>Published on: {{ $post->formatted_date }}</span>
        <span class="writer">Written by: {{ $post->user->name }}</span>
    </div>

    <div class="post-page-content">
        {!! $post->content !!}
    </div>
</div>