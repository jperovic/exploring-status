<?php
    namespace Exploring\StatusBundle\Engine;

    use Exploring\StatusBundle\Data\StatusObject;
    use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

    class SessionStatusEngine implements StatusEngineInterface
    {
        /**
         * @var FlashBag
         */
        private $bag;

        public function __construct(FlashBag $bag)
        {
            $this->bag = $bag;
        }

        /**
         * {@inheritdoc}
         */
        public function put($group, StatusObject $statusObject)
        {
            $this->bag->add($group, $statusObject);

            return $this;
        }

        /**
         * {@inheritdoc}
         */
        public function isEmpty($group)
        {
            return $this->bag->peek($group) === NULL;
        }

        /**
         * {@inheritdoc}
         */
        public function first($group)
        {
            if ( $this->isEmpty($group) ) {
                return NULL;
            }

            $messages = $this->bag->get($group);
            $first = array_shift($messages);
            $this->bag->set($group, $messages);

            return $first;
        }

        /**
         * {@inheritdoc}
         */
        public function all($group)
        {
            return $this->bag->get($group);
        }

        /**
         * {@inheritdoc}
         */
        public function clear($group)
        {
            $this->bag->get($group);

            return $this;
        }
    }