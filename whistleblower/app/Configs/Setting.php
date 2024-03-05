<?php

namespace App\Configs;

class Setting
{
    public const SETTING_OCCURRENCE_CREATED = 'occurrence.created';
    public const SETTING_OCCURRENCE_UPDATED = 'occurrence.updated';
    public const SETTING_OCCURRENCE_DELETED = 'occurrence.deleted';


    public const SETTING_OCCURRENCE_STATUS_NEW = 'New';
    public const SETTING_OCCURRENCE_STATUS_RECEIVED = 'Received';
    public const SETTING_OCCURRENCE_STATUS_INSPECTED = 'Beeing inspected';
    public const SETTING_OCCURRENCE_STATUS_WAITING = 'Waiting for whistleblower';
    public const SETTING_OCCURRENCE_STATUS_SEND_COMPANY = 'Sent to company';
    public const SETTING_OCCURRENCE_STATUS_CLOSED = 'Closed';

}
