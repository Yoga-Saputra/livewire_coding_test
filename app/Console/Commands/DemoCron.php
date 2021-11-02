<?php

namespace App\Console\Commands;

use App\Deposit;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = Deposit::create([
            'rekening_id'   => 3,
            'rekening_asal' => 11002211,
            'jumlah'        => 88888,
            'catatan'       => 'tes',
        ]);
        // $weekMap = [
        //     0 => 'senin',
        //     1 => 'selasa',
        //     2 => 'rabu',
        //     3 => 'kamis',
        //     4 => 'jumat',
        //     5 => 'sabtu',
        //     6 => 'minggu',
        // ];
        // $dayOfTheWeek = Carbon::now()->dayOfWeek;
        // $weekday = $weekMap[$dayOfTheWeek];
        // $data = 'aku sayang kamu sayang deh 123 :*';
        Log::info("Cron is working fine cika!" . $data);
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */

        $this->info('Demo:Cron Cummand Run successfully!');
    }
}
