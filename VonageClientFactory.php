<?php

namespace Vonage\ClientBundle;

use Vonage\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Vonage\Client\Credentials\Container;
use Vonage\Client\Credentials\Basic;
use Vonage\Client\Credentials\Keypair;
use Vonage\Client\Credentials\SignatureSecret;

class VonageClientFactory
{
    public static function createVonageClient(ContainerInterface $container)
    {
        $config = $container->getParameter('vonage_client');
        $credentials = [];
        if (!empty($config['api_key'])) {
            if (!empty($config['api_secret'])) {
                $credentials[] = new Basic($config['api_key'], $config['api_secret']);
            }

            if (!empty($config['signature_secret']) && !empty($config['signature_method'])) {
                $credentials[] = new SignatureSecret($config['api_key'], $config['signature_secret'], $config['signature_method']);
            }
        }

        if (!empty($config['application_id'])) {
            if (!empty($config['private_key_path'])) {
                $credentials[] = new Keypair(file_get_contents($config['private_key_path']), $config['application_id']);
            } elseif (!empty($config['private_key'])) {
                $credentials[] = new Keypair($config['private_key'], $config['application_id']);
            }
        }

        if (empty($credentials)) {
            throw new \RuntimeException('Must set Vonage credentials to use Vonage Client');
        }

        $credsContainer = new Container($credentials);
        return new Client($credsContainer);
    }
}

