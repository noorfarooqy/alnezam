<?php

namespace App\Mail\sharing;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class fileSharingMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $file_id;
    public $shared_id;
    public function __construct($sharetype, $file_id, $shared_id)
    {
        //
        $this->share_type = $sharetype;
        $this->file_id = $file_id;
        $this->shared_id = $shared_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $file_id = 
        return $this->subject("Al Nezam Shared a file with you")->markdown('sharing.file_mail');
    }
}
