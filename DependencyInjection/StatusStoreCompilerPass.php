<?php
    namespace Exploring\StatusBundle\DependencyInjection;

    use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\DependencyInjection\Reference;

    class StatusStoreCompilerPass implements CompilerPassInterface
    {

        /**
         * You can modify the container here before it is dumped to PHP code.
         *
         * @param ContainerBuilder $container
         *
         * @api
         */
        public function process(ContainerBuilder $container)
        {
            $container->getDefinition("exploring_status.manager")
                ->setArguments(array(new Reference($container->getParameter("exploring_status.engine"))));
        }
    }