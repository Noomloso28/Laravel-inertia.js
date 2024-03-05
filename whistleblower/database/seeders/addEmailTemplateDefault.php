<?php

namespace Database\Seeders;

use App\Mail\EmailNotification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MailTemplates;

class addEmailTemplateDefault extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $html_created = '<p>Hello,</p>
                 <p>thank you for submitting your case.<br>
                    You can view the current status of your case here:<br>
                    <a href="{{ report_url }}">Show Report</a></p>';

        MailTemplates::updateOrCreate([
            'company_id' => 0,
            'type' => 'occurrence.created'
        ],[
            'mailable' => EmailNotification::class,
            'subject' => 'Your case has been submitted',
            'html_template' => $html_created,
            'text_template' => '',
            'company_id' => 0,
            'default' => true,
            'type' => 'occurrence.created'
        ]);

        /**Admin default template **/
        MailTemplates::updateOrCreate([
            'company_id' => 0,
            'type' => 'occurrence.created.admin'
        ],[
            'mailable' => EmailNotification::class,
            'subject' => 'Your case has been submitted',
            'html_template' => $html_created,
            'text_template' => '',
            'company_id' => 0,
            'default' => true,
            'type' => 'occurrence.created.admin'
        ]);


        $html_updated = '<p>Hello,</p>
                 <p>your case has been updated.
                    You can view the current status and changes of your case here:<br>
                    <a href="{{ report_url }}">Show Report</a></p>';
        MailTemplates::updateOrCreate([
            'company_id' => 0,
            'type' => 'occurrence.updated'
        ],[
            'mailable' => EmailNotification::class,
            'subject' => 'Your case has been updated',
            'html_template' => $html_updated,
            'text_template' => '',
            'company_id' => 0,
            'default' => true,
            'type' => 'occurrence.updated'
        ]);
        /**Admin default template **/
        MailTemplates::updateOrCreate([
            'company_id' => 0,
            'type' => 'occurrence.updated.admin'
        ],[
            'mailable' => EmailNotification::class,
            'subject' => 'Your case has been updated',
            'html_template' => $html_updated,
            'text_template' => '',
            'company_id' => 0,
            'default' => true,
            'type' => 'occurrence.updated.admin'
        ]);

    }
}
