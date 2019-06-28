<?php

namespace App\Mail;

use Auth;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderRecieved extends Mailable
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
    public function build()
    {
		$user = Auth::user();
		$payment = Payment::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first();
        return $this->view('emails.order')->with(['user'=>$user, 'payment'=>$payment]);
    }
}
