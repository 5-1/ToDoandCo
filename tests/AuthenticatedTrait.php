<?php


namespace App\Tests;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

trait AuthenticatedTrait
{
    /**
     * Create a client with a default Authorization header.
     *
     * @param string $email
     * @param string $password
     *
     * @return KernelBrowser
     */
    protected function createAuthenticatedUser($email = 'ali@ali.com', $password = 'ali')
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail($email);

        $client->loginUser($testUser);

        return $client;
    }

    public function loginClient($email, $password)
    {
        return static::createClient([], [
            'PHP_AUTH_USER' => $email,
            'PHP_AUTH_PW'   => $password
        ]);
    }
}