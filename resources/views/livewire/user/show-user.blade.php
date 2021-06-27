<div wire:ignore.self style="width: 100%">
    <h2 class="text-center font-weight-bold">Management Users</h2>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-8">
                            <button type="button" class="btn btn-primary" wire:click="$emitTo('user.create-user', 'createUser')">
                                Create User
                            </button>
                        </div>
                        <div class="col-md-4">
                            <input wire:model="search" type="text" class="form-control" placeholder="Search Product">
                        </div>
                    </div>
                    <table class="table table-bordered table-sm table-hovered table-striped">
                        <thead>
                            <tr class="text-center">
                                <th width="2%">No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th width="17%">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index => $user)
                                <tr class="text-center">
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <button wire:click="$emitTo('user.update-user', 'updateUser', {{$user->id}})" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                                        <button wire:click="$emitTo('user.delete-user', 'deleteUser', {{$user->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <h5 class="text-center font-weight-bold text-primary" style="    position: relative;
                                bottom: -100px;">No Users found</h5>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="justify-content-center d-flex">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
