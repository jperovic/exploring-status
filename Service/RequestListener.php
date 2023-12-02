<?php

    namespace Exploring\StatusBundle\Service;

    use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
    use Symfony\Component\HttpKernel\Event\RequestEvent;

    class RequestListener
    {
        private $statusEngineType;

        private $flashBag;

        public function __construct($statusEngineType, FlashBag $flashBag)
        {
            $this->statusEngineType = $statusEngineType;
            $this->flashBag = $flashBag;
        }

        public function onKernelRequest(RequestEvent $event)
        {
            $session = $event->getRequest()->getSession();

            // We need to register the custom flash bag
            if ( $this->statusEngineType === "exploring_status.session_engine" && !$session->isStarted() )
            {
                $session->registerBag($this->flashBag);
            }
        }
    }