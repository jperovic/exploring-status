<?php
    namespace Exploring\StatusBundle\Data;

    class StatusObject
    {
        /**
         * @var int
         */
        private $error;

        /**
         * @var string
         */
        private $message;

        /**
         * @param  string $message
         * @param int     $error
         */
        function __construct($message, $error = 0)
        {
            $this->message = $message;
            $this->error = $error;
        }

        /**
         * @return int
         */
        public function getError()
        {
            return $this->error;
        }

        /**
         * @return string
         */
        public function getMessage()
        {
            return $this->message;
        }
    }