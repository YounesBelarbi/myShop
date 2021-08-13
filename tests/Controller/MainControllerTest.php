<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTest extends WebTestCase
{
    public function testMainPage()
    {
        $client = self::createClient();
        $crawler = $client->request('GET', '/');

        // Response test
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);

        // test if the number of products displayed is 12
        $this->assertCount(12, $crawler->filter('.card'));
    }
}
