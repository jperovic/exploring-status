<?php
    namespace Exploring\StatusBundle\Engine;

    use Exploring\StatusBundle\Data\StatusObject;

    class ApcStatusEngine implements StatusEngineInterface
    {
        /**
         * @var array
         */
        private $cache;

        private $cacheId;

        /**
         * @param string $cacheId
         */
        function __construct($cacheId)
        {
            $this->cacheId = $cacheId;

            $cache = apc_fetch($cacheId);
            $this->cache = is_array($cache) ? $cache : array();
        }

        /**
         * {@inheritdoc}
         */
        public function put($group, StatusObject $statusObject)
        {
            $this->initCacheGroup($group);
            $this->cache[$group][] = $statusObject;
            $this->save();

            return $this;
        }

        /**
         * {@inheritdoc}
         */
        public function isEmpty($group)
        {
            return !array_key_exists($group, $this->cache) || !is_array($this->cache[$group]) || !count($this->cache[$group]);
        }

        /**
         * {@inheritdoc}
         */
        public function first($group)
        {
            if ( $this->isEmpty($group) ) {
                return NULL;
            }

            $first = array_shift($this->cache[$group]);
            $this->save();

            return $first;
        }

        /**
         * @param string $group
         *
         * @return StatusObject[]
         */
        public function all($group)
        {
            $data = array_key_exists($group, $this->cache) ? $this->cache[$group] : array();

            apc_delete($this->cacheId);

            return $data;
        }


        /**
         * @param string $group
         *
         * @return StatusEngineInterface
         */
        public function clear($group)
        {
            if ( array_key_exists($group, $this->cache) ) {
                unset($this->cache[$group]);
                $this->save();
            }

            return $this;
        }

        private function initCacheGroup($group)
        {
            $cache = apc_fetch($this->cacheId);

            return is_array($cache) && array_key_exists($group, $cache) ? $cache[$group] : $this->cache[$group] = array();
        }

        private function save()
        {
            apc_store($this->cacheId, $this->cache);
        }
    }
