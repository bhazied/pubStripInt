<?php

namespace ContinuousNet\PubliPrBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('publi_pr');


        $rootNode
            ->children()

                ->arrayNode('settings')
                    ->children()
                        ->scalarNode('default_currency')
                            ->defaultValue('EUR')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->integerNode('default_price')
                            ->defaultValue(30)
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('url_public_path')
                    ->children()
                        ->scalarNode('free')
                            ->defaultValue('free')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('paied')
                            ->defaultValue('client')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('uplopad')
                    ->children()
                        ->scalarNode('main_dir')
                            ->defaultValue('/var/www/publipr/web/')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
