<?php
/**
 * Created by JetBrains PhpStorm.
 * User: GabrielCol
 * Date: 3/27/13
 * Time: 11:06 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Wmds\MindBodyAPIBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;

class WmdsMindBodyAPIExtension extends Extension{

    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        /* set config data into container parameter for later use into the bundle */
        $container->setParameter('wmds_mind_body_api_data', $config);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    public function getAlias()
    {
        return 'wmds_mind_body_api';
    }
}