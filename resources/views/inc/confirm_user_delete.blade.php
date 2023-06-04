<div class="modal fade" id="staticBackdrop{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm Deletion</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        @if ($user->posts->count() > 0 || $user->banners->count() > 0)
            <div class="modal-body">
                <p>This user account: <b>"{{ $user->name.' ('.$user->email.')' }}"</b>, cannot be deleted.</p>
                <p>It has <strong>{{ $user->posts->count() }} posts</strong> &amp; <strong>{{ $user->banners->count() }} banner ads</strong> linked to it.</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-appprimary" data-bs-dismiss="modal">Close</button>
            </div>
        @else
            <div class="modal-body">
            <p>Do you want to delete the user account for:</p><b>"{{ $user->name.' ('.$user->email.')' }}"</b>?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No, cancel action</button>
            <form action="{{ route('users.destroy', $user)}}" method="post">
                @csrf
                @method('DELETE')

                <input type="submit" value="Yes" class="btn btn-appprimary">
            </form>
            </div>
        @endif
      </div>
    </div>
</div>