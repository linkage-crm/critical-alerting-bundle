<?php

namespace LinkageCrm\CriticalAlertingBundle\Entity;


class TelegramNotification extends AbstractNotification
{
    public function __toString(): string
    {
        return "Project: $this->project_name\n\n" .
            "<blockquote>Message: $this->message</blockquote>\n" .
            "<blockquote>File: \n$this->file\n" .
            "Line: $this->line</blockquote>";
    }
}