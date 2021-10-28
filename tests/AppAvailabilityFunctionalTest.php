<?php


namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AppAvailabilityFunctionalTest extends WebTestCase
{

use AuthenticatedTrait;


    /**
     * @param $url
     * @param $expectedStatus
     * @dataProvider smokeTestProvider
     **/
    public function testSmokeTest($url,$expectedStatus, $method)
    {
        $client = static::createClient();
        $client->request($method, $url);
        $this->assertSame($expectedStatus, $client->getResponse()->getStatusCode());
    }


    public function smokeTestProvider(): \Generator
    {
        yield "login" => ['/login', 200, 'GET'];
        yield "logout" => ['/logout', 302, 'POST'];
        yield "home" => ['/', 200, 'GET'];
        yield "task_list" => ['/tasks', 302, 'GET'];
        yield "task_create" => ['/tasks/create', 200, 'GET'];
        yield "task_edit" =>  ['/tasks/26/edit', 302, 'GET'];
        yield "tot" =>  ['/tasks/26/toggle', 302, 'GET'];
        yield "task_delete" => ['/tasks/26/delete', 302, 'DELETE'];
        yield "user_create" => ['/users/create', 200, 'GET'];
        yield "user_list" => ['/users', 302, 'GET'];
        yield "user_create" => ['/users/create', 302, 'GET'];
        yield "user_edit" => ['/users/19/edit', 302, 'GET'];


    }

    private function assertSameTest($expectedStatus, int $getStatusCode)
    {
    }

    public function urlProvider()
    {
        return array(
            array('/'),
            array('/login'),
            array('/logout'),
            array('/tasks'),
            array('/tasks/{id}/edit'),
            array('/tasks/{id}/toggle'),
            array('/tasks/{id}/delete'),
            array('/tasks/create'),
        );
    }


}