
<div class="tags">
    @if (strlen($post->tags) > 1)
    <h6>TAGS:</h6>
    <p>
        @php
            $tags_array = explode(',', $post->tags)
        @endphp
        @foreach ($tags_array as $tag)
            <span class="btn btn-sm btn-outline-secondary">{{ $tag }}</span>
        @endforeach
    </p>
    @endif
</div>