<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Occurrences;
use Illuminate\Support\Facades\Log;

class OccurrencesSendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug('Occurrence sended the message to Queues ready :'. $this->data['detail']['email']);
        /** send email to user lists */
        $occurrences = new Occurrences();
        $occurrences->sendEmail(
            $this->data['company'],
            $this->data['name'],
            $this->data['value'],
            $this->data['detail']
        );
    }
}
