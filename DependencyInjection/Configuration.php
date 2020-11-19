<?php
declare(strict_types=1);

namespace Vonage\ClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('vonage_client');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('api_key')->end()
                ->scalarNode('api_secret')->end()
                ->scalarNode('signature_secret')->end()
                ->scalarNode('signature_method')->end()
                ->scalarNode('private_key')->end()
                ->scalarNode('private_key_path')->end()
                ->scalarNode('application_id')->end()
            ->end()
        ;
        return $treeBuilder;
    }
}

