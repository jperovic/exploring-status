<?php
    namespace Exploring\StatusBundle\Engine;

    use Exploring\StatusBundle\Data\StatusObject;

    interface StatusEngineInterface
    {
        /**
         * @param StatusObject $statusObject
         *
         * @return $this
         */
        public function set(StatusObject $statusObject);

        /**
         * @return bool
         */
        public function has();

        /**
         * @return StatusObject
         */
        public function first();

        /**
         * @return StatusObject[]
         */
        public function all();
    }