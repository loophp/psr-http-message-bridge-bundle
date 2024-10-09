<?php

declare(strict_types=1);

namespace spec\loophp\PsrHttpMessageBridgeBundle\DependencyInjection;

use loophp\PsrHttpMessageBridgeBundle\DependencyInjection\PsrHttpMessageBridgeExtension;
use PhpSpec\ObjectBehavior;

class PsrHttpMessageBridgeExtensionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(PsrHttpMessageBridgeExtension::class);
    }
}
