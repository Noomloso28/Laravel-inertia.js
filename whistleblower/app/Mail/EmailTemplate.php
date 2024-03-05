<?php

namespace App\Mail;

use App\Models\MailTemplates;
use App\Models\User;
use Spatie\MailTemplates\Models\MailTemplate;
use Spatie\Permission\Models\Role;

class EmailTemplate extends MailTemplate
{
    protected string $subject = '';

    protected string $html_template = '';

    public function __construct(protected int $companyId = 0, protected string $type = 'occurrence.created', bool $isSystemUser = false, array $attributes = [])
    {
        $this->setTable('mail_templates');

        if ($isSystemUser) {
            $this->type .= '.admin';
        }

        $mailTemplateData = $this->loadMailTemplate();

        parent::__construct($attributes);

        $this->subject = $mailTemplateData['subject'] ?? '';
        $this->html_template = $mailTemplateData['html_template'] ?? '';

    }

    protected function loadMailTemplate(): array
    {
        $query = MailTemplates::where('mailable', 'App\Mail\EmailNotification');

        if (count($this->getCompanyTemplate()) > 0) {
            $query->where('company_id', '=', $this->companyId)->where('type', $this->type);
        } else {
            $query->where('default', '=', true)->where('type', $this->type);
        }
        $query->get();

        if ($query->count()) {
            return $query->first()->toArray();
        }

        return [];
    }

    protected function getCompanyTemplate(): array
    {
        $template = MailTemplates::where('company_id', '=', $this->companyId)->where('type', $this->type)->get();
        if ($template->count()) {
            return $template->first()->toArray();
        }
        return [];
    }

    protected function getDefaultTemplate(): array
    {
        $template = MailTemplates::where('default', true)->get();
        if ($template->count()) {
            return $template->first()->toArray();
        }
        return [];
    }

    /**
     * Get Email Template with user role
     */
    protected function getEmailTemplateByRole(string $type): string
    {
        switch ($type) {
            case "occurrence.created":
                $type = $this->checkTypeTemplate($type);
                break;
            case "occurrence.updated":
                $type = $this->checkTypeTemplate($type);
                break;
            default:
                $type = $this->type;
        }

        return $type;
    }

    protected function checkTypeTemplate(string $type): string
    {
        if ($this->checkAdminTemplate($type)) {
            return $type . '.admin';
        }
        return $type;
    }

    protected function checkAdminTemplate(string $type): bool
    {
        $adminTemp = $this->type . '.admin';
        $template = MailTemplates::where('company_id', '=', $this->companyId)->where('type', $adminTemp)->get();

        if ($template->count()) {
            return true;
        }
        return false;
    }

    /**
     * Get Role name by static email
     * @return string
     */
    protected function getUserRoleByEmail(): string
    {
        $user = User::where('email', $this->email)->first();
        if ($user && $user->role_id) {
            return $this->getRoleNameById($user->role_id);
        }
        return '';
    }

    /**
     * Send role name string type and check by static email
     *
     * @param int $roleId
     * @return string
     */
    protected function getRoleNameById(int $roleId): string
    {
        $role = Role::find($roleId)->first();
        return $role->name ?? '';
    }
}
