<?php
    namespace Exploring\StatusBundle\Service;

    use Exploring\StatusBundle\Data\StatusObject;
    use Exploring\StatusBundle\Engine\StatusEngineInterface;

    class StatusManager
    {
        const MESSAGE_TYPE = "operation.status";

        /**
         * @var StatusEngineInterface
         */
        private $engine;

        /**
         * @param StatusEngineInterface $engine
         */
        function __construct(StatusEngineInterface $engine)
        {
            $this->engine = $engine;
        }

        /**
         * @param string $message
         * @param int    $error
         *
         * @return $this
         */
        public function set($message, $error = 0)
        {
            $this->engine->set(new StatusObject($message, $error));

            return $this;
        }

        /**
         * @return bool
         */
        public function hasStatus()
        {
            return $this->engine->has();
        }

        /**
         * @return StatusObject[]
         */
        public function all()
        {
            return $this->engine->all();
        }

        /**
         * @return StatusObject
         */
        public function first()
        {
            return $this->engine->first();
        }
    }
