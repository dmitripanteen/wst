<?php

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Component\Router\RouterFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Wst\Component\Catalogue\Administrator\Extension\CatalogueComponent;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\RouterFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\CMS\HTML\Registry;
use Joomla\DI\ServiceProviderInterface;

return new class implements ServiceProviderInterface
{

    public function register(Container $container): void
    {
        $container->registerServiceProvider(
            new MVCFactory('\\Wst\\Component\\Catalogue')
        )->registerServiceProvider(
            new ComponentDispatcherFactory('\\Wst\\Component\\Catalogue')
        )->registerServiceProvider(
            new RouterFactory('\\Wst\\Component\\Catalogue')
        );
        $container->set(
            ComponentInterface::class,
            function (Container $container) {
                $component =
                    new CatalogueComponent(
                        $container->get(
                            ComponentDispatcherFactoryInterface::class
                        )
                    );
                $component->setRegistry($container->get(Registry::class));
                $component->setMVCFactory(
                    $container->get(MVCFactoryInterface::class)
                );
                $component->setRouterFactory(
                    $container->get(RouterFactoryInterface::class)
                );

                return $component;
            }
        );
    }
};
