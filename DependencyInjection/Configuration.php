<?php
/**
 * Created by JetBrains PhpStorm.
 * User: GabrielCol
 * Date: 3/27/13
 * Time: 10:56 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Wmds\MindBodyAPIBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {

    public function getConfigTreeBuilder()
    {
        /**
         * @param TreeBuilder;
         */
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('wmds_mind_body_api')
            ->children()
                ->booleanNode('sandbox')
                    ->defaultTrue()
                    ->end()
                ->booleanNode('debug')
                    ->defaultFalse()
                    ->end()
                ->scalarNode('api_user')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->end()
                ->scalarNode('api_key')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->end()
                ->arrayNode('site_ids')
                    ->defaultValue(array(-99))
                    ->prototype('scalar')
                        ->end()
                    ->end()
                ->scalarNode('xml')
                    ->defaultValue('Full')
                    ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}