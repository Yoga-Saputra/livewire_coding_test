<?php

namespace App\Http\Livewire\Deposit;

use App\Deposit;
use App\Rekening;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateDeposit extends Component
{
    public $rekening_id;
    public $rekening_asal;
    public $jumlah;
    public $catatan;

    protected $listeners = ['reloadCreateDeposit' => '$refresh'];

    public function render()
    {
        $rekening = Rekening::all();
        return view('livewire.deposit.create-deposit', [
            'rekening'  => $rekening
        ]);
    }
    public function rules()
    {
        return [
            'rekening_id'  => 'required',
            'rekening_asal' => 'required',
            'catatan' => 'required',
            'jumlah' => 'required',
        ];
    }

    private function initializedProperties()
    {
        $this->resetErrorBag();
        $this->rekening_id = null;
        $this->rekening_asal = null;
        $this->catatan = null;
        $this->jumlah = null;
    }

    public function save()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            Deposit::create([
                'rekening_id'   => $this->rekening_id,
                'rekening_asal' => $this->rekening_asal,
                'jumlah'        => $this->jumlah,
                'catatan'       => $this->catatan,
            ]);
            $this->emit('flashMessage', [
                'type'  => 'success',
                'message' => 'User Created Successfully'
            ]);
            // $this->emit('closeModal', 'createUserModal');
            $this->emit('reloadCreateDeposit');
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
}
