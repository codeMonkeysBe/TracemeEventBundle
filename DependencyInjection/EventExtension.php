<?php

namespace CodeMonkeys\IntelliTrail\Bundle\EventBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class EventExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {

        $loader = new YamlFileLoader( $container, new FileLocator( __DIR__ . '/../Resources/config' ) ) ;
        $loader->load( 'config.yml' );

        foreach( $configs as $tree ){
            foreach( $tree as $key => $element ){

                $fullKey = sprintf( "%s.%s",  $this->getAlias(), $key ) ;
                $container->setParameter( $fullKey, $element );

            }
        }

    }
}


