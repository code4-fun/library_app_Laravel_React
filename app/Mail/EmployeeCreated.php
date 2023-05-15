<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmployeeCreated extends Mailable{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   */
  public function __construct(public $email, public $password){
  }

  /**
   * Get the message envelope.
   */
  public function envelope():Envelope{
    return new Envelope(
      subject: 'Регистрация в Library app',
    );
  }

  /**
   * Get the message content definition.
   */
  public function content():Content{
    return new Content(
      view: 'emails.employeeCreated',
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array<int, \Illuminate\Mail\Mailables\Attachment>
   */
  public function attachments():array{
    return [];
  }
}