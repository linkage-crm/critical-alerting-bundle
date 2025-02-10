<?php

namespace LinkageCrm\CriticalAlertingBundle\Entity;

abstract class AbstractNotification
{
    protected string $project_name;
    protected string $message;
    protected string $file;
    protected int    $line;

    abstract public function __toString(): string;

    public static function createFromThrowable(\Throwable $e): self
    {
        $notification = new static();
        $notification
            ->setProjectName($_ENV['CRITICAL_ALERTING_PROJECT_NAME'] ?? '')
            ->setMessage($e->getMessage())
            ->setFile($e->getFile())
            ->setLine($e->getLine());

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

    public function getFile(): string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;
        return $this;
    }

    public function getLine(): int
    {
        return $this->line;
    }

    public function setLine(int $line): self
    {
        $this->line = $line;
        return $this;
    }
}