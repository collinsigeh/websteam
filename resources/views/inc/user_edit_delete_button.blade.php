<div class="mb-3 p-3 text-center bg-appgrey">
    <input type="submit" value="Save changes" class="btn btn-appprimary m-1">
    @if ($user->id !== Auth::user()->id && $user->is_primary_user !== 1)
        <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $user->id }}" title="Delete">Delete user</button>
    @endif
</div>