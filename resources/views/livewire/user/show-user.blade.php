<div wire:ignore.self style="width: 100%">
    <h2 class="text-center font-weight-bold">Management Users</h2>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-8">
                            {{-- <button type="button" class="btn btn-primary" wire:click="$emitTo('user.create-user', 'createUser')">
                                Create User
                            </button> --}}
                        </div>
                        <div class="col-md-4">
                            <input wire:model="search" type="text" class="form-control" placeholder="Search Product">
                        </div>
                    </div>
                    <table class="table table-bordered ">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form wire:submit.prevent="save">
                                <tr>
                                    <td></td>
                                    <td>
                                        <input wire:model="name" type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="enter your name">
                                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </td>
                                    <td>
                                        <input wire:model="email" type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="enter your email">
                                        @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </td>
                                    <td class="text-center">
                                        <button type="submit" class="btn btn-icon btn-sm"><i class="fa fa-plus fa-23"></i></button>
                                    </td>
                                </tr>
                            </form>
                        @forelse ($users as $index => $user)
                                <tr class="text-center">
                                    <td>{{ $index+1 }}</td>
                                    <td>
                                        @if ($name !== $index)
                                            {{ $user['name'] }}
                                        @else
                                            <input  type="text" wire:model.defer="users.{{$index}}.name" class="form-control @error('name') is-invalid @enderror">
                                            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        @endif
                                    </td>
                                    <td>
                                        @if ($email !== $index)
                                            {{ $user['email'] }}
                                        @else
                                            <input  type="email" wire:model.defer="users.{{$index}}.email" class="form-control @error('email') is-invalid @enderror">
                                            @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        @endif
                                    </td>
                                    <td>
                                        <button wire:click="$emitTo('user.update-user', 'updateUser', {{$user->id}})" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                                        {{-- <button wire:click="$emitTo('user.delete-user', 'deleteUser', {{$user->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button> --}}
                                        <button wire:click="delete({{$user->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                        @empty
                            <h5 class="text-center font-weight-bold text-primary">No Users found</h5>
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
