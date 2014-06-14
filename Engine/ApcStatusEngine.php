<?php
    namespace Exploring\StatusBundle\Engine;

    use Exploring\StatusBundle\Data\StatusObject;
    use Exploring\StatusBundle\Service\StatusManager;

    class ApcStatusEngine implements StatusEngineInterface
    {
        /**
         * {@inheritdoc}
         */
        public function set(StatusObject $statusObject)
        {
            $messages = $this->getCache();
            $messages[] = $statusObject;

            apc_store(StatusManager::MESSAGE_TYPE, $messages);

            return $this;
        }

        /**
         * {@inheritdoc}
         */
        public function has()
        {
            return $this->getCache();
        }

        /**
         * {@inheritdoc}
         */
        public function first()
        {
            if (!$this->has()) {
                return NULL;
            }

            $messages = $this->getCache();

            $first = array_shift($messages);

            apc_store(StatusManager::MESSAGE_TYPE, $messages);

            return $first;
        }

        /**
         * @return StatusObject[]
         */
        public function all()
        {
            $data = $this->getCache();

            apc_delete(StatusManager::MESSAGE_TYPE);

            return $data ? $data : array();
        }

        /**
         * @return StatusObject[]
         */
        private function getCache()
        {
            return apc_fetch(StatusManager::MESSAGE_TYPE);
        }
    }