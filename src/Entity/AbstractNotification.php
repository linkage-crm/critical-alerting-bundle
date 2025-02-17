<?php

namespace LinkageCrm\CriticalAlertingBundle\Entity;

abstract class AbstractNotification
{
    protected string $project_name;
    protected string $message;
    protected string $trace;

    abstract public function __toString(): string;

    public static function createFromThrowable(\Throwable $e): self
    {
        $notification = new static();
        $notification
            ->setProjectName($_ENV['CRITICAL_ALERTING_PROJECT_NAME'] ?? '')
            ->setMessage($e->getMessage())
            ->setTrace($e->getTraceAsString());

        return $notification;
    }

    public function getProjectName(): string
    {
        return $this->project_name;
    }

    public function setProjectName(string $project_name): self
    {
        $this->project_name = $project_name;
        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getTrace(): string
    {
        return $this->trace;
    }

    public function setTrace(string $trace): self
    {
        $this->trace = $trace;
        return $this;
    }
}