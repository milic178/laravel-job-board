<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $user,public $token)
    {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Password Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content();
    }

    public function build()
    {
        $urlResetPassword = url('password/reset/' . $this->token);
        return $this->subject('Reset Password Notification')
            ->view('emails.reset-password')
            ->with([
                'title' => 'Password Reset',
                'greeting' => 'Hello!',
                'messageContent' => 'You are receiving this email because we received a password reset request for your account.',
                'messageContent2' => 'This password reset link will expire in 60 minutes.
If you did not request a password reset, no further action is required.',
                'actionText' => 'Reset Password',
                'actionUrl' => $urlResetPassword,
                'closingText' => 'Thank you, jobBoardApp',
                'subcopy' => 'If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: ' . $urlResetPassword,
            ]);
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
