<div class="modal fade" id="staticBackdropPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Change Password</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('changepassword')}}" method="post">
            @csrf
            @method('PATCH')
            <div class="modal-body">
                <div class="form-group mb-3">
                  <label for="password">New Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password"  autocomplete="current-password">
                
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="password_confirmation">Confirm Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Re-type Password"  autocomplete="current-password">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel action</button>

                <input type="submit" value="Submit" class="btn btn-appprimary">
            </div>
        </form>
      </div>
    </div>
</div>