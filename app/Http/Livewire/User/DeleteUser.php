<?php

namespace App\Http\Livewire\User;

use App\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DeleteUser extends Component
{
    // public $userId;
    public $name;
    public $email;
    public $password;

    protected $listeners = [
        'deleteUser' => 'showModal'
    ];


    public function mount()
    {
        $this->initializedProperties();
    }


    public function render()
    {
        return view('livewire.user.delete-user');
    }
    public function delete($userId)
    {
        DB::beginTransaction();
        try {
            $usr = User::findOrFail($userId)->get();
            $usr->delete();
            $this->emit('flashMessage', [
                'type'  => 'success',
                'message' => 'User Delete Successfully'
            ]);
            $this->emit('closeModal', 'deleteUserModal');
            $this->emit('reloadUsers');
            $this->initializedProperties();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->emit('flashMessage', [
                'type'  => 'error',
                'message' => 'Error: ' .  $th->getMessage()
            ]);
        }
        DB::commit();
    }

    // public function showModal(User $user)
    // {
    //     $this->userId = $user->id;
    //     $this->name = $user->name;
    //     $this->email = $user->email;
    //     $this->emit('showModal', 'deleteUserModal');
    // }

    private function initializedProperties()
    {
        $this->userId = null;
        $this->name = null;
        $this->email = null;
        $this->password = null;
    }
}
