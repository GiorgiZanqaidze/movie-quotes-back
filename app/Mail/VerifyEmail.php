<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 */
	protected $data;

	public function __construct($data)
	{
		$this->data = $data;
	}

	/**
	 * Get the message envelope.
	 */
	public function envelope(): Envelope
	{
		return new Envelope(
			subject: 'Verify Email Mail',
		);
	}

	/**
	 * Get the message content definition.
	 */
	public function content(): Content
	{
		return new Content(
			view: 'mails.register-mail',
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

	public function build()
	{
		app()->setLocale(app()->getLocale());
		return $this->view('mails.register-mail')
		->with(['token' => $this->data->remember_token])
		->with(['name'=> $this->data->name]);
	}
}
