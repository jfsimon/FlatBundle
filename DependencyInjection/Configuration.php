<?php

namespace BeSimple\FlatBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration
{
    /**
     * Generates the configuration tree.
     *
     * @return Symfony\Component\Config\Definition\NodeInterface
     */
    public function getConfigTree()
    {
        $treeBuilder = new TreeBuilder();

        return $treeBuilder
                ->root('besimple_flat')
                ->children()
                ->scalarNode('cache_dir')->defaultValue('%kernel.cache_dir%')->end()
                ->scalarNode('default_component_namespace')->defaultValue('FlatComponent')->end()
                ->end()
                ->end()
                ->buildTree();
    }
}
