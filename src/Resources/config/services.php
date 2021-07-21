<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Bridge\PsrHttpMessage\ArgumentValueResolver\PsrServerRequestResolver;
use Symfony\Bridge\PsrHttpMessage\EventListener\PsrResponseListener;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Bridge\PsrHttpMessage\HttpFoundationFactoryInterface;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;

return static function (ContainerConfigurator $container) {
    $services = $container->services();

    $services
        ->defaults()
        ->autoconfigure()
        ->autowire();

    $services
        ->set(HttpFoundationFactory::class);

    $services
        ->alias(HttpFoundationFactoryInterface::class, HttpFoundationFactory::class);

    $services
        ->set(PsrHttpFactory::class);

    $services
        ->alias(HttpMessageFactoryInterface::class, PsrHttpFactory::class);

    $services
        ->set(PsrServerRequestResolver::class)
        ->tag('controller.argument_value_resolver');

    $services
        ->set(PsrResponseListener::class)
        ->tag(
            'kernel.event_listener',
            [
                'event' => 'kernel.view',
            ]
        );
};
