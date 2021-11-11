<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends WebTestCase
{
    use AuthenticatedTrait;

    public function testListUser(): void
    {
        $client = $this->createAuthenticatedUser();
        $client->request('GET', '/users');
        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testCreateUser()
    {
        $client = $this->createAuthenticatedUser();
        $client->request('GET', '/users/create');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->submitForm('Ajouter', [
            'user[username]' => 'testAdduser' . uniqid(),
            'user[plainPassword][first]' => 'testAddmdp',
            'user[plainPassword][second]' => 'testAddmdp',
            'user[email]' => 'testEdit' . uniqid() . 'test@test.fr',
        ]);

        $this->assertResponseRedirects('/users');

//        $crawler = $client->followRedirect();
        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains('strong', 'Superbe');
    }

    public function testEditUser()
    {
        $client = $this->createAuthenticatedUser('ali@ali.com', 'ali');
        $client->request('GET', '/users/2/edit');

        $client->submitForm('Modifier', [
            'edit_user[username]' => 'testEdit' . uniqid(),
            'edit_user[plainPassword][first]' => 'testAddmdp',
            'edit_user[plainPassword][second]' => 'testAddmdp',
            'edit_user[email]' => 'testEdit' . uniqid() . 'test@test.fr',
            'edit_user[roles][0]' => 'ROLE_USER',
        ]);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $client->followRedirect();
        $this->assertSelectorTextContains('body', 'utilisateur a bien été modifié');
    }
}
