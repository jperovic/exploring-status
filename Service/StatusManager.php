<?php
    namespace Exploring\StatusBundle\Service;

    use Exploring\StatusBundle\Data\StatusObject;
    use Exploring\StatusBundle\Engine\StatusEngineInterface;

    class StatusManager
    {
        const DEFAULT_GROUP = "Default";

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
         * @param string $group
         * @param bool   $exclusive
         *
         * @return $this
         */
        public function success($message, $group = self::DEFAULT_GROUP, $exclusive = TRUE)
        {
            $this->put($message, $group, NULL, StatusObject::LEVEL_SUCCESS, $exclusive);

            return $this;
        }

        /**
         * @param string     $message
         * @param string     $group
         * @param \Exception $cause
         * @param bool       $exclusive
         *
         * @return $this
         */
        public function error($message, $group = self::DEFAULT_GROUP, \Exception $cause = NULL, $exclusive = TRUE)
        {
            $this->put($message, $group, $cause, StatusObject::LEVEL_ERROR, $exclusive);

            return $this;
        }

        /**
         * @param string     $message
         * @param string     $group
         * @param \Exception $cause
         * @param bool       $exclusive
         *
         * @return $this
         */
        public function warning($message, $group = self::DEFAULT_GROUP, \Exception $cause = NULL, $exclusive = TRUE)
        {
            $this->put($message, $group, $cause, StatusObject::LEVEL_WARN, $exclusive);

            return $this;
        }

        /**
         * @param string     $message
         * @param string     $group
         * @param \Exception $cause
         * @param int        $level
         * @param bool       $exclusive
         *
         * @return $this
         */
        private function put($message, $group = self::DEFAULT_GROUP, \Exception $cause = NULL, $level = 0, $exclusive = TRUE)
        {
            if ( $exclusive ) {
                $this->engine->clear($group);
            }
            $this->engine->put($group, new StatusObject($message, $cause, $level));

            return $this;
        }

        /**
         * @param string $group
         *
         * @return bool
         */
        public function isEmpty($group = self::DEFAULT_GROUP)
        {
            return $this->engine->isEmpty($group);
        }

        /**
         * @param string $group
         *
         * @return StatusObject[]
         */
        public function all($group = self::DEFAULT_GROUP)
        {
            return $this->engine->all($group);
        }

        /**
         * @param string $group
         *
         * @return StatusObject
         */
        public function first($group = self::DEFAULT_GROUP)
        {
            return $this->engine->first($group);
        }

        /**
         * @param string $group
         *
         * @return StatusEngineInterface
         */
        public function clear($group = self::DEFAULT_GROUP)
        {
            return $this->engine->clear($group);
        }
    }
