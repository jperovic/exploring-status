<?php

    namespace Exploring\StatusBundle;

    use Exploring\StatusBundle\DependencyInjection\StatusStoreCompilerPass;
    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\HttpKernel\Bundle\Bundle;

    class ExploringStatusBundle extends Bundle
    {
        public function build(ContainerBuilder $container)
        {
            parent::build($container);

            $container->addCompilerPass(new StatusStoreCompilerPass());
        }
    }
