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
     */
    public function testSmokeTest($url,$expectedStatus, $method)
    {
        $client = static::createClient();
        $client->request($method, $url);
        $this->assertSame($expectedStatus, $client->getResponse()->getStatusCode());
    }


    public function smokeTestProvider(){
        yield "sws" => ['/login', 200, 'GET'];
        yield ['/logout', 302, 'POST'];
        yield ['/', 200, 'GET'];
        yield ['/tasks', 200, 'GET'];
        yield ['/tasks/create', 200, 'GET'];
        yield "cfgc" =>  ['/tasks/2/edit', 200, 'GET'];
        yield  "tot" =>  ['/tasks/2/toggle', 302, 'GET'];
        yield ",mlk,m" =>  ['/tasks/2/delete', 302, 'DELETE'];
        yield ['/users/create', 200, 'GET'];
        yield ['/users', 200, 'GET'];
        yield ['/users/create', 200, 'GET'];
        yield ['/users/1/edit', 200, 'GET'];


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