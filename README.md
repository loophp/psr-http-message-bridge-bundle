[![Latest Stable Version][latest stable version]][1]
 [![GitHub stars][github stars]][1]
 [![Total Downloads][total downloads]][1]
 [![GitHub Workflow Status][github workflow status]][2]
 [![Scrutinizer code quality][code quality]][3]
 [![Type Coverage][type coverage]][4]
 [![Code Coverage][code coverage]][3]
 [![License][license]][1]
 [![Donate!][donate github]][5]
 [![Donate!][donate paypal]][6]

# PSR HTTP Message Bridge Bundle

This bundle will register in your Symfony application's container a couple of services.

Those services are from the [symfony/psr-http-message-brige][10] bridge package.

It provides:

* An argument value resolver to be able to get the following objects through:
  * `Psr\Http\Message\MessageInterface`
  * `Psr\Http\Message\RequestInterface`
  * `Psr\Http\Message\ServerRequestInterface`

  Those are directly derived from the current Symfony Request object.

  It means that you can directly get a PSR7 Request in Symfony controllers through
  method parameters.

* An event listener that let users return PSR7 Responses in Symfony controllers.
  Basically, this event will check if the return value of a Response is an instance of
  `Psr\Http\Message\ResponseInterface` and only if it's the case, will convert it into
  a Symfony response.

* Factories:
  * A `HttpFoundactionFactory` service to convert PSR requests into Symfony requests.
  * A `PsrHttpFactory` service to convert Symfony requests into PSR requests.

# Requirements

* PHP >= 7.3
* Symfony >= 4

# Installation

```bash
composer require loophp/psr-http-message-bridge-bundle
```

Once the bundle installed in your application, it's ready to use, there is no configuration to set up.

# Usage

```php
<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class HelloWorldController {

    private ResponseFactoryInterface $responseFactory;
    private StreamFactoryInterface $streamFactory;

    public function __construct(ResponseFactoryInterface $responseFactory, StreamFactoryInterface $streamFactory)
    {
        $this->responseFactory = $responseFactory;
        $this->streamFactory = $streamFactory;
    }

    /**
     * @Route("/hello-world", name="hello_world")
     */
    public function __invoke(RequestInterface $psrRequest): ResponseInterface {
        // You can do something with $psrRequest if needed.

        // Build the PSR response.
        $response = $this->responseFactory->createResponse();

        // Return the new PSR response.
        return $response->withBody($this->streamFactory->createStream('Hello world!'));
    }
}
```

## Code quality, tests and benchmarks

Every time changes are introduced into the library, [Github][11] run the tests and the benchmarks.

The library has tests written with [PHPSpec][12].
Feel free to check them out in the `spec` directory. Run `composer phpspec` to trigger the tests.

Before each commit some inspections are executed with [GrumPHP][13], run `./vendor/bin/grumphp run` to check manually.

[PHPInfection][14] is used to ensure that your code is properly tested, run `composer infection` to test your code.

## Contributing

Feel free to contribute by sending Github pull requests. I'm quite responsive :-)

## Changelog

See [CHANGELOG.md][15] for a changelog based on [git commits][16].

For more detailed changelogs, please check [the release changelogs][17].

[1]: https://packagist.org/packages/loophp/psr-http-message-bridge-bundle
[2]: https://github.com/loophp/psr-http-message-bridge-bundle/actions
[latest stable version]: https://img.shields.io/packagist/v/loophp/psr-http-message-bridge-bundle.svg?style=flat-square
[github stars]: https://img.shields.io/github/stars/loophp/psr-http-message-bridge-bundle.svg?style=flat-square
[total downloads]: https://img.shields.io/packagist/dt/loophp/psr-http-message-bridge-bundle.svg?style=flat-square
[github workflow status]: https://img.shields.io/github/workflow/status/loophp/psr-http-message-bridge-bundle/Unit%20tests?style=flat-square
[code quality]: https://img.shields.io/scrutinizer/quality/g/loophp/psr-http-message-bridge-bundle/master.svg?style=flat-square
[3]: https://scrutinizer-ci.com/g/loophp/psr-http-message-bridge-bundle/?branch=master
[type coverage]: https://img.shields.io/badge/dynamic/json?style=flat-square&color=color&label=Type%20coverage&query=message&url=https%3A%2F%2Fshepherd.dev%2Fgithub%2Floophp%2Fpsr-http-message-bridge-bundle%2Fcoverage
[4]: https://shepherd.dev/github/loophp/psr-http-message-bridge-bundle
[code coverage]: https://img.shields.io/scrutinizer/coverage/g/loophp/psr-http-message-bridge-bundle/master.svg?style=flat-square
[license]: https://img.shields.io/packagist/l/loophp/psr-http-message-bridge-bundle.svg?style=flat-square
[donate github]: https://img.shields.io/badge/Sponsor-Github-brightgreen.svg?style=flat-square
[donate paypal]: https://img.shields.io/badge/Sponsor-Paypal-brightgreen.svg?style=flat-square
[5]: https://github.com/sponsors/drupol
[6]: https://www.paypal.me/drupol
[10]: https://github.com/symfony/psr-http-message-bridge
[11]: https://github.com/loophp/psr-http-message-bridge-bundle/actions
[12]: http://www.phpspec.net/
[13]: https://github.com/phpro/grumphp
[14]: https://github.com/infection/infection
[15]: https://github.com/phpstan/phpstan
[16]: https://github.com/vimeo/psalm
[15]: https://github.com/loophp/psr-http-message-bridge-bundle/blob/master/CHANGELOG.md
[16]: https://github.com/loophp/psr-http-message-bridge-bundle/commits/master
[17]: https://github.com/loophp/psr-http-message-bridge-bundle/releases
