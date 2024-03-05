<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Spatie\MailTemplates\TemplateMailable;

class EmailNotification extends TemplateMailable
{
    use Queueable, SerializesModels;
    protected static $templateModelClass = EmailTemplate::class;

    private array $information;
    public string $company_name;
    public string $company_logo_url;
    public string $report_url;

    /**
     * Create a new message instance.
     *
     * @param array $infomation
     * @return void
     */
    public function __construct(array $infomation, $email = '', bool $isSystemUser = false)
    {
        $this->mailTemplate = new static::$templateModelClass(
            (int)  $infomation['company_id'],
            $infomation['setting_name'] ?? 'occurrence.created',
            $isSystemUser
        );

        $this->information = $infomation;
        $this->company_name = $infomation['company_name'] ?? '';
        $this->company_logo_url = $infomation['company_logo_url'] ?? '';
        $this->report_url = $infomation['report_url'] ?? '';

        $this->information['subject'] = $this->mailTemplate->getSubject();
    }

    public function build()
    {
        return $this;
    }

    /**
     * @ Spatie\MailTemplates\TemplateMailable
     *
     * @return string
     */
    public function getHtmlLayout(): string
    {
//        $pathToLayout = storage_path('mail-layouts/main.html');
        $pathToLayout = resource_path('views/mail/notification.blade.php');

        return file_get_contents($pathToLayout);
//        return view('mail.notification')->render();
    }


    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->information['subject'] ??'Email Notification',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.notification',
            with: [
                'name' => $this->information['name'] ?? '',
                'email' => $this->information['email'] ?? '',
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }
}
