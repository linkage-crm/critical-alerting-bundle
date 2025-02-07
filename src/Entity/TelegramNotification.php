<?php

namespace LinkageCrm\CriticalAlertingBundle\Entity;


class TelegramNotification extends AbstractNotification
{
    public function __toString(): string
    {
        return "IP: $this->ip\n\n" .
               "<blockquote>Message: $this->message</blockquote>\n" .
               "<blockquote>File: \n$this->file\n" .
			   "Line: $this->line</blockquote>";
    }
}