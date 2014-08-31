<?php
    namespace Exploring\StatusBundle\Data;

    class StatusObject
    {
        const LEVEL_SUCCESS = 0;

        const LEVEL_WARN = 1;

        const LEVEL_ERROR = 2;

        /**
         * @var int
         */
        private $level;

        /**
         * @var string
         */
        private $message;
        /**
         * @var \Exception
         */
        private $cause;

        /**
         * @param  string    $message
         * @param \Exception $cause
         * @param int        $level
         */
        function __construct($message, \Exception $cause = null, $level = self::LEVEL_SUCCESS)
        {
            $this->message = $message;
            $this->level = $level;
            $this->cause = $cause;
        }

        /**
         * @return int
         */
        public function getLevel()
        {
            return $this->level;
        }

        /**
         * @return bool
         */
        public function isError()
        {
            return $this->level == self::LEVEL_ERROR;
        }

        /**
         * @return bool
         */
        public function isWarning()
        {
            return $this->level == self::LEVEL_WARN;
        }

        /**
         * @return bool
         */
        public function isSuccess()
        {
            return $this->level == self::LEVEL_SUCCESS;
        }

        /**
         * @return \Exception
         */
        public function getCause()
        {
            return $this->cause;
        }

        /**
         * @return string
         */
        public function getMessage()
        {
            return $this->message;
        }
    }