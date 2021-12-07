<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Test class for functional testing of class MainController/
 * test suite for functional testing of class MainController.
 */
// class ControllerMainTest extends WebTestCase
class ControllerMainTest extends WebTestCase
{
    private $client;

    /**
     * Text fixture - to prepare before a test case
     * Runs before every test method in the class.
     * Below row 31 calls KernelTestCase::bootKernel() and
     * creates a "client" that is acting as the browser:
     */
    protected function setUp(): void
    {
        /**
         * Below row calls KernelTestCase::bootKernel() and
         * creates a "client" that is acting as the browser:
         */
        $this->client = static::createClient();
        // $this->client->followRedirects();
    }

    /**
     * Testcase that asserts that the controller start returns:
     * - a response with correct status code
     * - a successful response
     * - a response that contains the correct content
     */
    public function testControllerStartReturnsStatusCodeAndContent()
    {
        $this->client->request('GET', '/');

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Katja');

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller me returns:
     * - a response with correct status code
     * - a successful response
     * - a HTML element with attribute class="heading"
     * - a response that contains the correct content
     */
    public function testControllerMeReturnsStatusCodeAndContent()
    {
        $crawler = $this->client->request('GET', '/me');

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.heading'));
        $this->assertSelectorTextContains('h1', 'Katja');
        $this->assertSelectorTextContains('h5', 'plockar kantareller och lingon, lagar god mat och ser på film och hockey');

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller about returns:
     * - a response with correct status code
     * - a successful response
     * - a response that contains the correct content
     */
    public function testControllerAboutReturnsStatusCodeAndContent()
    {
        $crawler = $this->client->request('GET', '/about');

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Katja');
        $this->assertSelectorTextContains('h3', 'Katjas about-sida');

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller invalidPath returns:
     * - a response with correct status code
     * - a successful response
     * - a response that contains the correct content
     */
    public function testControllerInvalidPathReturnsStatusCodeAndContent()
    {
        $crawler = $this->client->request('GET', '/katja');

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Katja');
        $this->assertSelectorTextContains('h2', 'Page localhost:8000');

        // unset($client);
    }
}
