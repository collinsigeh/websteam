
<p class="card-post-date">
    @if ($post->created_at == $post->updated_at)
      {{ $post->updated_at->diffForHumans() }}
    @else
      updated {{ $post->updated_at->diffForHumans() }}
    @endif
  </p>