<?php

namespace App\Http\Livewire\User;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUser extends Component
{
    public $name;
    public $email;
    protected $listeners = [
        'reloadUsers' => '$refresh',
        'createUser' => 'showModal'
    ];


    public function mount()
    {
        $this->initializedProperties();
    }

    public function updated($property, $value)
    {
        if (trim($value)) {
            $this->validateOnly($property);
        } else {
            $this->resetValidation($property);
        }
    }

    public function render()
    {
        return view('livewire.user.create-user');
    }

    public function showModal()
    {
        $this->emit('showModal', 'createUserModal');
    }
    public function save()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            User::create([
                'name'      => $this->name,
                'email'     => $this->email,
                'password'  => Hash::make('password')
            ]);
            $this->emit('flashMessage', [
                'type'  => 'success',
                'message' => 'User Created Successfully'
            ]);
            $this->emit('closeModal', 'createUserModal');
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
            'email' => 'required|email|unique:users,email,',
        ];
    }

    private function initializedProperties()
    {
        $this->resetErrorBag();
        $this->name = null;
        $this->email = null;
    }
}
