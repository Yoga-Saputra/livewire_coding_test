<?php

namespace App\Http\Livewire\Deposit;

use App\Deposit;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MasterDeposit extends Component
{
    protected $listeners = ['reloadDeposit' => '$refresh'];


    public function render()
    {
        $deposit    = Deposit::with('rekening')->get();
        $count    = Deposit::with('rekening')->where('status', 'Pending')->count();
        // dd($deposit);
        return view('livewire.deposit.master-deposit', [
            'deposits' => $deposit,
            'count' => $count
        ]);
    }

    public function reload($depositId)
    {
        DB::beginTransaction();
        try {
            Deposit::findOrFail($depositId)->update([
                'status'      => 'Pending',
            ]);
            $this->emit('flashMessage', [
                'type'  => 'success',
                'message' => 'Deposit Reload Successfully'
            ]);
            $this->emit('reloadDeposit');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->emit('flashMessage', [
                'type'  => 'error',
                'message' => 'Error: ' .  $th->getMessage()
            ]);
        }
        DB::commit();
    }

    public function approved($depositId)
    {
        DB::beginTransaction();
        try {
            Deposit::findOrFail($depositId)->update([
                'status'      => 'Approve',
            ]);
            $this->emit('flashMessage', [
                'type'  => 'success',
                'message' => 'Deposit Approved Successfully'
            ]);
            $this->emit('reloadDeposit');
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
