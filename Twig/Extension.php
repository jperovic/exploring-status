<?php
    namespace Exploring\StatusBundle\Twig;

    use Exploring\StatusBundle\Service\StatusManager;
    use Twig_Environment;

    class Extension extends \Twig_Extension
    {
        /** @var StatusManager */
        private $statusManager;

        function __construct(StatusManager $statusManager)
        {
            $this->statusManager = $statusManager;
        }

        public function getFunctions()
        {
            return array(
                new \Twig_SimpleFunction('ExploringStatus_First', function (Twig_Environment $environment, $group = StatusManager::DEFAULT_GROUP) {
                    return $environment->render(
                        '@ExploringStatusBundle::single.html.twig', array('status' => $this->statusManager->first($group))
                    );
                }, array('needs_environment' => TRUE, 'is_safe' => array('html'))),

                new \Twig_SimpleFunction('ExploringStatus_All', function (Twig_Environment $environment, $group = StatusManager::DEFAULT_GROUP) {
                    return $environment->render(
                        '@ExploringStatusBundle::all.html.twig', array('status' => $this->statusManager->all($group))
                    );
                }, array('needs_environment' => TRUE, 'is_safe' => array('html')))
            );
        }

        /**
         * Returns the name of the extension.
         *
         * @return string The extension name
         */
        public function getName()
        {
            return "exploring_status_bundle_extension";
        }
    }