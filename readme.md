# Parlons design pattern : parlons observateur en PHP

Ce pattern est très connu et couramment utilisé dans le monde du développement. Il peut être facilement implémenté en PHP grâce à la bibliothèque **symfony/event-dispatcher**.

---

## Comment fonctionne le pattern observateur ?

Imaginez ce pattern comme une situation réelle : trois individus discutent ensemble. L’un d’eux partage une information importante avec les deux autres. Cette personne est **l’émetteur** (ou **dispatcher**) : elle diffuse l’information. Les deux autres sont des **observateurs** (ou **listeners**) : ils écoutent et peuvent réagir ou interagir s’ils le souhaitent.  

Entre ces deux rôles (émetteur et observateurs), nous avons **l’événement**, qui correspond ici à l’information transmise.

---

## Implémentation du code

Après cette introduction, voyons comment le code est implémenté !

Si vous voulez tester ce code, vous devez installer `symfony/event-dispatcher` avec Composer avant de l’exécuter.

~~~bash
composer require symfony/event-dispatcher
~~~

---

### `index.php`

~~~php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Event\VoiceEvent;
use App\EventSubscriber\VoiceSubscriber;
use Symfony\Component\EventDispatcher\EventDispatcher;

$dispatcher = new EventDispatcher();

$subscriber1 = new VoiceSubscriber();
$subscriber2 = new VoiceSubscriber();

$dispatcher->addListener('event.message', [$subscriber1, 'doSomething']);
$dispatcher->addListener('event.message', [$subscriber2, 'doSomethingElse']);

$event = new VoiceEvent('Voici un message important.');

$dispatcher->dispatch($event, 'event.message');
~~~

Dans ce script, nous créons un $dispatcher et lui associons deux listeners. Ensuite, nous créons deux subscribers, qui représentent les deux personnes qui écoutent l’émetteur. VoiceEvent contient simplement le message que l’émetteur transmet. Enfin, nous dispatchons l’événement VoiceEvent : les deux subscribers peuvent réagir comme ils le souhaitent.

---

### `src/EventSubscriber/VoiceSubscriber.php`

~~~php
<?php

namespace App\EventSubscriber;

use App\Event\VoiceEvent;

class VoiceSubscriber
{
    public function doSomething(VoiceEvent $voiceEvent): void
    {
        echo "Réaction 1 : " . $voiceEvent->getMessage() . PHP_EOL;
    }

    public function doSomethingElse(VoiceEvent $voiceEvent): void
    {
        echo "Réaction 2 : " . $voiceEvent->getMessage() . PHP_EOL;
    }
}
~~~

Ici, nous définissons les actions des listeners. Les fonctions sont précisées dans index.php.

---

### `src/Event/VoiceEvent.php`

~~~php
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
~~~

L’événement contient le message que l’émetteur transmet, accessible via la propriété $message.

---

## Pourquoi utiliser ce pattern ?

Cette implémentation est très utile quand vous voulez **découpler votre code en plusieurs parties**.  
Vous obtenez un code plus **maintenable** et vous ne bloquez pas vos futures implémentations grâce à la modularité.  
Chaque élément qui écoute est libre de traiter l’information comme il le souhaite, sans impacter les autres observers.

## Conclusion

De nombreux frameworks implémentent ce système d’observateur via différentes mécaniques. On peut le retrouver dans de nombreux langages et environnements de développement, que ce soit en PHP avec Symfony ou Laravel, en JavaScript avec Node.js, ou même en Java et C#.