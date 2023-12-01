<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\QueueNumber;
use App\Models\Patient;

class ResetQueueNumbers extends Command
{
    protected $signature = 'queue:reset';

    protected $description = 'Reset QueueNumbers and update Patient queue_number_id to null';

    public function handle()
    {
        // Hapus semua entri di model QueueNumber
        QueueNumber::truncate();

        // Update queue_number_id di model Patient menjadi null
        Patient::whereNotNull('queue_number_id')->update(['queue_number_id' => null]);
        Patient::where('status_pemeriksaan', 'Belum Diperiksa')->delete();
        $this->info('QueueNumbers reset and Patient queue_number_id updated.');
    }
}
