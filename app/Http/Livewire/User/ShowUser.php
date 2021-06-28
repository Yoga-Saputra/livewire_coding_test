<?php

namespace App\Http\Livewire\User;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUser extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $name;
    public $email;

    protected $listeners = ['reloadUsers' => '$refresh'];

    public function render()
    {
        return view('livewire.user.show-user', [
            'users' => User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'DESC')
                ->paginate(5)
        ]);
    }
    // protected $listeners = [
    //     'reloadUsers' => '$refresh',
    //     'createUser' => 'showModal'
    // ];


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

    public function delete($userId)
    {
        DB::beginTransaction();
        try {
            $usr = User::findOrFail($userId)->delete();
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
