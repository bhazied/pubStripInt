<?php

namespace ContinuousNet\PubliPrBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class PubliPrExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('publipr.contact.address', $config['contact']['address']);
        $container->setParameter('publipr.contact.email', $config['contact']['email']);
        $container->setParameter('publipr.settings.default_currency', $config['settings']['default_currency']);
        $container->setParameter('publipr.settings.default_vat', $config['settings']['default_vat']);
        //newsroom url prefix
        $container->setParameter('publipr.url_public_path.free', $config['url_public_path']['free']);
        $container->setParameter('publipr.url_public_path.paied', $config['url_public_path']['paied']);
        //piwik
        $container->setParameter('publipr.piwik.token', $config['piwik']['token']);
        $container->setParameter('publipr.piwik.response_format', $config['piwik']['response_format']);
        $container->setParameter('publipr.piwik.date_format', $config['piwik']['date_format']);
    }
}
