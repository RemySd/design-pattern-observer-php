<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class VoiceEvent extends Event
{
    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
