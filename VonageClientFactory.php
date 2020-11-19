<?php

namespace Vonage\ClientBundle;

use Vonage\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Vonage\Client\Credentials\Container;
use Vonage\Client\Credentials\Basic;

class VonageClientFactory
{
    public static function createVonageClient(ContainerInterface $container)
    {
        $config = $container->getParameter('vonage_client');
        $credentials = [];
        if (!empty($config['api_key']) && !empty($config['api_secret'])) {
            $credentials[] = new Basic($config['api_key'], $config['api_secret']);
        }

        if (empty($credentials)) {
            throw new \RuntimeException('Must set vonage credentials to use Vonage Client');
        }

        $credsContainer = new Container($credentials);
        return new Client($credsContainer);
    }
}

