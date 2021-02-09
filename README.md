# Vonage Client Bundle for Symfony
[![Contributor Covenant](https://img.shields.io/badge/Contributor%20Covenant-v2.0%20adopted-ff69b4.svg)](CODE_OF_CONDUCT.md)
[![Apache 2.0 licensed](https://img.shields.io/badge/license-Apache%202.0-blue.svg)](./LICENSE.txt)

<img src="https://developer.nexmo.com/assets/images/Vonage_Nexmo.svg" height="48px" alt="Nexmo is now known as Vonage" />

This is the Vonage API PHP client bundle for use with the Symfony Framework.
To use this, you'll need a Vonage account. Sign up [for free at nexmo.com][signup].

**This bundle is currently in development/beta status, so there may be bugs**

 * [Installation](#installation)
 * [Usage](#usage)
 * [Contributing](#contributing) 

## Installation

### Applications that use Symfony Flex

```console
$ composer require vonage/symfony
```

### Applications that don't use Symfony Flex

#### Step 1: Download the bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require vonage/symfony
```

#### Step 2: Enable the bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Vonage\ClientBundle\VonageClientBundle::class => ['all' => true],
];
```

### Configuration

You can configure the bundle with your application details by creating a YAML
file with your credentials. The easiest way is to dump the config and copy
it to `configs/packages/vonage_client.yaml`.

```console
$ bin/console config:dump-reference VonageClientBundle
```

You can then fill in the needed credentials from your [Vonage Dashboard][dashboard].

## Usage

This bundle takes care of all the client creation needed for making the Vonage
client, and adds it to the service container. All you need to do is add your
credentials and any other info like Vonage Application ID to your config. You
can pull the class from the service container or use it as part of the
autowiring system.

```php
namespace App\Controller;

use Vonage\Client;
use Vonage\SMS\Message\SMS;

class MyController
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function myAction(): Response
    {
        $this->client->sms()->send(
            new SMS($toNumber, $vonageNumber, 'This is an SMS!')
        );
    }
}
```

[signup]: https://dashboard.nexmo.com/sign-up?utm_source=DEV_REL&utm_medium=github&utm_campaign=php-symfony-bundle
[dashboard]: https://dashboard.nexmo.com?utm_source=DEV_REL&utm_medium=github&utm_campaign=php-symfony-bundles
[issues]: https://github.com/nexmo/vonage-php-symfony-bundle/issues
[pulls]: https://github.com/nexmo/vonage-php-symfony-bundle/pulls

