<?php

namespace App\Jobs;

use App\Models\Occurrences;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OccurrencesGuestCommentSendEmail implements ShouldQueue
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
        /** send email to user lists */
        $occurrences = new Occurrences();
        $occurrences->sendEmailToUsers($this->data['company_id'], $this->data['setting_name'], true, $this->data);
    }
}
