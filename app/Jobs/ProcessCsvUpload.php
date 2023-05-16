<?php

namespace App\Jobs;

use App\Services\SupplierService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCsvUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected mixed $id;
    protected mixed $csvFile;


    /**
     * Create a new job instance.
     */
    public function __construct($supermarketId, $csvFile)
    {
        $this->id = $supermarketId;
        $this->csvFile = $csvFile;
    }

    /**
     * Execute the job.
     */
    public function handle(SupplierService $service): void
    {
        $service->uploadSuppliers($this->id, $this->csvFile);

    }
}
