
<div class="mb-3 p-3 text-end bg-appgrey">
    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-appprimary">Edit post contents</a>
    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $post->id }}" title="Delete">Delete post</button>
</div>