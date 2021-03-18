<?php
namespace App\Tests;

use App\Tests\AuthenticatedTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class UserControllerTest extends WebTestCase
{
    use AuthenticatedTrait;

    public function testCreateUser()
    {
        $client = $this->loginClient('ali@ali.com', 'ali');
        $client->request('GET', '/users/create');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->submitForm('Ajouter', [
            'user[username]' => 'testAdduser' . uniqid(),
            'user[password][first]' => 'testAddmdp',
            'user[password][second]' => 'testAddmdp',
            'user[email]' => 'testEdit' . uniqid() . 'test@test.fr',
            'user[roles][0]' => 'ROLE_USER'
        ]);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $client->followRedirect();
        $this->assertContains("utilisateur a bien été ajouté.", $client->getResponse()->getContent());
    }

    public function testEditUser()
    {
        $client = $this->loginClient('ali@ali.com', 'ali');
        $client->request('GET', '/users/2/edit');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->submitForm('Modifier', [
            'user[username]' => 'testEdit' . uniqid(),
            'user[password][first]' => 'testAddmdp',
            'user[password][second]' => 'testAddmdp',
            'user[email]' => 'testEdit' . uniqid() . 'test@test.fr',
            'user[roles][0]' => 'ROLE_USER'
        ]);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $client->followRedirect();
        $this->assertContains("utilisateur a bien été modifié", $client->getResponse()->getContent());
    }
}
