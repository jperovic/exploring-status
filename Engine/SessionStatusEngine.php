<?php
    namespace Exploring\StatusBundle\Engine;

    use Exploring\StatusBundle\Data\StatusObject;
    use Exploring\StatusBundle\Service\StatusManager;
    use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
    use Symfony\Component\HttpFoundation\Session\SessionInterface;

    class SessionStatusEngine implements StatusEngineInterface
    {
        const BAG_NAME = "flashes";

        /**
         * {@inheritdoc}
         */
        function __construct(SessionInterface $session)
        {
            $this->session = $session;
        }

        /**
         * {@inheritdoc}
         */
        public function set(StatusObject $statusObject)
        {
            $this->getBag()->add(StatusManager::MESSAGE_TYPE, $statusObject);

            return $this;
        }

        /**
         * {@inheritdoc}
         */
        public function has()
        {
            return $this->getBag()->peek(StatusManager::MESSAGE_TYPE);
        }

        /**
         * {@inheritdoc}
         */
        public function first()
        {
            if (!$this->has()) {
                return NULL;
            }

            $messages = $this->getBag()->get(StatusManager::MESSAGE_TYPE);

            $first = array_shift($messages);

            $this->getBag()->set(StatusManager::MESSAGE_TYPE, $messages);

            return $first;
        }

        /**
         * @return StatusObject[]
         */
        public function all()
        {
            return $this->getBag()->get(StatusManager::MESSAGE_TYPE);
        }

        /**
         * @return FlashBag
         */
        private function getBag()
        {
            return $this->session->getBag(self::BAG_NAME);
        }
    }