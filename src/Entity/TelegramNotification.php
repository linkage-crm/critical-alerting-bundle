<?php

namespace LinkageCrm\CriticalAlertingBundle\Entity;


class TelegramNotification extends AbstractNotification
{
    public function __toString(): string
    {
        return "Project: $this->project_name\n\n" .
            "<blockquote expandable>Message: $this->message</blockquote>\n" .
            "<blockquote expandable>Trace: \n$this->trace</blockquote>";
    }
}