<form wire:submit.prevent="delete">
    <div wire:ignore.self class="modal fade" id="deleteUserModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <p class="text-center">
                  Are you sure want to delete <strong>{{$name}}</strong> user <br> with email <strong>{{$email}}</strong> ??
              </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
            <button type="submit" class="btn btn-primary">Delete</button>
          </div>
        </div>
      </div>
  </div>
</form>