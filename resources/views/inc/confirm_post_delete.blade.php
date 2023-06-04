<div class="modal fade" id="staticBackdrop{{ $post->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm Deletion</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Do you want to delete the post titled:</p><b>"{{ $post->title }}"</b>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No, cancel action</button>
          <form action="{{ route('posts.destroy', $post->id)}}" method="post">
            @csrf
            @method('DELETE')

            <input type="submit" value="Yes" class="btn btn-appprimary">
          </form>
        </div>
      </div>
    </div>
</div>