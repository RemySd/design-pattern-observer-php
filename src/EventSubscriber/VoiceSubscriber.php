<?php

namespace App\EventSubscriber;

use App\Event\VoiceEvent;

class VoiceSubscriber
{
    public function doSomething(VoiceEvent $voiceEvent): void
    {
        echo "Scratch your hair: " . $voiceEvent->getMessage() . PHP_EOL;
    }

    public function doSomethingElse(VoiceEvent $voiceEvent): void
    {
        echo "Scratch your nose: " . $voiceEvent->getMessage() . PHP_EOL;
    }
}
