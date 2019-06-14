<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        return $this->from($request->email)
                    ->subject($request->subject)
                    ->markdown('emails.contact.us')
                    ->with([
                        'name' => $request->name,
                        'subject' => $request->subject,
                        'message' => $request->message,
                        'email' => $request->email
                    ]);
    }
}
