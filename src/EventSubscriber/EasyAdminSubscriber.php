<?php

namespace App\EventSubscriber;

use App\Entity\BlogPost;
use App\Entity\Dishes;
use DateTime;
use DateTimeImmutable;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    

    public function __construct()
    {
        
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setTimestamp'],
        ];
    }

    public function setTimestamp(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        
        $entity->setCreatedAt(new DateTimeImmutable());
        $entity->setUpdatedAt(new DateTimeImmutable());
    }
    


}