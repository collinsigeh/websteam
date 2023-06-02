<div class="modal fade" id="staticBackdrop{{ $banner->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm Deletion</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Do you want to delete the banner ad titled: <b>"{{ $banner->title }}"</b>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No, cancel action</button>
          <form action="{{ route('banners.destroy', $banner->id)}}" method="post">
            @csrf
            @method('DELETE')

            <input type="submit" value="Yes" class="btn btn-appprimary">
          </form>
        </div>
      </div>
    </div>
</div>