<form wire:submit.prevent="update">
    <div wire:ignore.self class="modal fade" id="updateUserModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update User</h5>
            <button wire:click="cancle" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                  <label>name</label>
                  <input wire:model="name" type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="enter your name">
                  @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror

              </div>
              <div class="form-group">
                  <label>email</label>
                  <input wire:model="email" type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="enter your email">
                  @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror

              </div>
              <div class="form-group">
                <label>password</label>
                <input wire:model="password" type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="enter your password">
                @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror

            </div>
          </div>
          <div class="modal-footer">
            <button wire:click="cancle" type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </div>
      </div>
  </div>
</form>