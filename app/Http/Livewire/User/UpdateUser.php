<?php

namespace App\Http\Livewire\User;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdateUser extends Component
{
    public $name;
    public $email;
    public $userId;
    public $password;

    protected $listeners = [
        'updateUser' => 'showModal'
    ];

    public function mount()
    {
        $this->initializedProperties();
    }

    public function render()
    {
        return view('livewire.user.update-user');
    }

    public function showModal(User $user)
    {
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->emit('showModal', 'updateUserModal');
    }
    public function updated($property, $value)
    {
        if (trim($value)) {
            $this->validateOnly($property);
        } else {
            $this->resetValidation($property);
        }
    }

    public function update()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            User::findOrFail($this->userId)->update([
                'name'      => $this->name,
                'email'     => $this->email,
                'password'  => Hash::make($this->password)
            ]);
            $this->emit('flashMessage', [
                'type'  => 'success',
                'message' => 'User Updated Successfully'
            ]);
            $this->emit('closeModal', 'updateUserModal');
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

    public function cancle()
    {
        $this->initializedProperties();
    }
    public function rules()
    {
        return [
            'name'  => 'required|max:10',
            'email' => 'required|email|unique:users,email,' . $this->userId,
        ];
    }

    private function initializedProperties()
    {
        $this->resetErrorBag();
        $this->name = null;
        $this->email = null;
        $this->password = null;
    }
}
