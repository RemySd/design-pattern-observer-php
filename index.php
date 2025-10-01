<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Event\VoiceEvent;
use App\EventSubscriber\VoiceSubscriber;
use Symfony\Component\EventDispatcher\EventDispatcher;

// Création du dispatcher
$dispatcher = new EventDispatcher();

// Création des listeners (subscribers)
$subscriber1 = new VoiceSubscriber();
$subscriber2 = new VoiceSubscriber();

// Ajout des listeners à l'événement
$dispatcher->addListener('event.blabla', [$subscriber1, 'doSomething']);
$dispatcher->addListener('event.blabla', [$subscriber2, 'doSomethingElse']);

// Création de l'événement
$event = new VoiceEvent('bla bla bla');

// Dispatch de l'événement
$dispatcher->dispatch($event, 'event.blabla');
