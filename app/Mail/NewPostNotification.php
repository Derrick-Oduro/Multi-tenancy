<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewPostNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $post;

    public function __construct( $post )
    {
        $this->post = $post;
    }

    public function build()
    {
        return $this->view('emails.new_post_notification')
                    ->with([
                        'postTitle' => is_array($this->post) ? $this->post['title'] : $this->post->title,
                        'postBody' => is_array($this->post) ? $this->post['body'] : $this->post->body,
                        'postUrl' => is_array($this->post) ? url('/posts/' . $this->post['id']) : url('/posts/' . $this->post->id),
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Post Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.new_post_notification',
        );
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
