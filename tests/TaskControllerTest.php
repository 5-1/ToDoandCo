<?php

namespace App\Tests;

use App\Tests\AuthenticatedTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TaskControllerTest extends WebTestCase
{


    use AuthenticatedTrait;

    public function testList(): void
    {
        $client = $this->createAuthenticatedUser();
        $client->request('GET', '/tasks');
        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }


    public function testDelete(): void
    {
        $user = $this->createAuthenticatedUser('ali@ali.com');
        $user->request('DELETE', '/tasks/1/delete');
        $this->assertSame(Response::HTTP_FOUND, $user->getResponse()->getStatusCode());
    }


    public function testCreateTaskAuthorized()
    {
        $client = $this->loginClient('ali@ali.com', 'ali');
        $client->request('GET', '/tasks/create');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $uniqId = uniqid();
        $client->submitForm('Ajouter', [
            'task[title]' => 'Titre tâche de test : ' . $uniqId,
            'task[content]' => 'Contenu tâche de test'
        ]);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $client->followRedirect();
        $this->assertContains("Titre tâche de test : " . $uniqId, $client->getResponse()->getContent());
    }

    public function testEditAction()
    {
        $client = $this->loginClient('ali@ali.com', 'ali');
        $client->request('GET', '/tasks/1/edit');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $uniqId = uniqid();
        $client->submitForm('Modifier', [
            'task[title]' => 'Titre MODIFIER de test : ' . $uniqId,
            'task[content]' => 'Contenu MODIFIER de test'
        ]);
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $client->followRedirect();
        $this->assertContains("Titre tâche de test : " . $uniqId, $client->getResponse()->getContent());


    }


}