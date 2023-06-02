
<div class="mb-3 p-3 text-end bg-appgrey">
    <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-sm btn-appprimary">Edit banner ad</a>
    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $banner->id }}" title="Delete">Delete banner ad</button>
</div>