<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public User $user, public string $confirmEmailUrl)
    {
        //
    }

    public function build()
    {
        return $this->subject('Welcome to JobBoardApp')
        ->view('emails.welcome')
        ->with([
            'title' => 'Welcome to JobBoardApp',
            'greeting' => 'Hello!',
            'messageContent' => 'You are receiving this email because we received a password reset request for your account.',
            'userName' => $this->user->name,
            'actionText' => 'Confirm Email',
            'actionUrl' => $this->confirmEmailUrl,
            'closingText' => 'Thank you, jobBoardApp',
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to JobBoardApp',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content();
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
