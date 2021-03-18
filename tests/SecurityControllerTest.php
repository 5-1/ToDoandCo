<?php

namespace App\Tests;

use App\Tests\AuthenticatedTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends WebTestCase
{

    public function testAuthentificationUser()
    {
        $this->client = static::createClient();
        $this->client->request('GET', '/login');
        $crawler = $this->client->submitForm('Se connecter', ['email' => 'ali@ali.com', 'password' => 'ali']);

      $this->assertResponseRedirects("");



    }
}