<?php

namespace App\Jobs;

use App\Models\Note;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Note $note;

    /**
     * Create a new job instance.
     */
    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $noteUrl = config('app.url') . '/notes/' . $this->note->id;
        $emailContent = "Hello, you've received a new note. View it here: {$noteUrl}";

        try {
            Mail::raw($emailContent, function ($message) {
                $message->from('sendnotes@test.com', 'SendNotes')
                    ->to($this->note->recipient)
                    ->subject('You have a new Note from ' . $this->note->user->name);
            });

            Log::info("Email sent successfully for note ID {$this->note->id} to {$this->note->recipient}.");
        } catch (\Exception $e) {
            Log::error("Failed to send email for note ID {$this->note->id} to {$this->note->recipient}. Error: {$e->getMessage()}");
        }
    }
}
