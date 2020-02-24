<?php

namespace App\Tests;

use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class IAmAliveControllerTest
 *
 * @package App\Tests
 */
class IAmAliveControllerTest extends WebTestCase
{
    /** @test */
    public function itReturnsA200StatusCode()
    {
        $client = $this->createClient();
        $client->request(
            'GET',
            '/adapter/comments/i_am_alive'
        );

        $this->assertEquals('200', $client->getResponse()->getStatusCode());
    }
}
