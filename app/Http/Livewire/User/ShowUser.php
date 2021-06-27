<?php

namespace App\Http\Livewire\User;

use App\User;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUser extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;

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
}
