<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

trait AuthenticatedTrait
{
    /**
     * Create a client with a default Authorization header.
     *
     * @param string $password
     */
    protected function createAuthenticatedUser(string $email = 'ali@ali.com', $password = 'ali'): KernelBrowser
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail($email);

        $client->loginUser($testUser);

        return $client;
    }
}
