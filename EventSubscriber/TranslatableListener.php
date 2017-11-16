<?php

namespace Wandi\I18nBundle\EventSubscriber;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class TranslatableListener
{
    private $requestStack;
    private $defaultLocale;

    public function __construct(RequestStack $requestStack, $defaultLocale)
    {
        $this->requestStack = $requestStack;
        $this->defaultLocale = $defaultLocale;
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $request = $this->requestStack->getCurrentRequest();
        $entity = $args->getObject();
        $traits = class_uses($entity);
        if (in_array("Wandi\\I18nBundle\\Traits\\TranslatableEntity", $traits)) {
            $entity->setLocale(($request) ? $request->getLocale() : $this->defaultLocale);
        }
    }
}
