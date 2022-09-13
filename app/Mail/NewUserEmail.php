<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Hi {$this->user->name} welcome to my website";
        return $this
            ->from('an.doan.1232@gmail.com')
            ->to($this->user->email)
            ->subject($subject)
            ->view('mail.new_user')
            ->with([
                'messageTxt' => "This is mail send form system base on Laravel"
            ])
            ->attachFromStorage("public/fiola-full-hd.jpg");
    }
}
