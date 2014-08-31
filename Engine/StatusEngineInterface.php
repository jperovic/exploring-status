<?php
    namespace Exploring\StatusBundle\Engine;

    use Exploring\StatusBundle\Data\StatusObject;

    interface StatusEngineInterface
    {
        /**
         * @param string       $group
         * @param StatusObject $statusObject
         *
         * @return $this
         */
        public function put($group, StatusObject $statusObject);

        /**
         * @param string $group
         *
         * @return bool
         */
        public function isEmpty($group);

        /**
         * @param string $group
         *
         * @return StatusObject
         */
        public function first($group);

        /**
         * @param string $group
         *
         * @return StatusObject[]
         */
        public function all($group);

        /**
         * @param string $group
         *
         * @return StatusEngineInterface
         */
        public function clear($group);
    }