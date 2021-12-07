<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Test class for functional testing of class ControllerBookTest/
 * test suite for functional testing of class ControllerBookTest.
 */
class ControllerBookTest extends WebTestCase
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
     * Testcase that asserts that the controller index returns:
     * - a response with correct status code
     * - a successful response
     * - a response that contains the correct content
     * - two <p> HTML elements
     */
    public function testControllerIndexReturnsStatusCodeAndContent()
    {
        $crawler = $this->client->request('GET', '/book/');

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('p', 'Sorry, there are no books to show!');
        $this->assertCount(2, $crawler->filter('p'));
    }

    /**
     * Testcase that asserts that the controller fetchAllBooks returns:
     * - a response with correct status code
     * - a successful response
     * - a HTML element with attribute class="books-table"
     * - a response that contains the correct content
     */
    public function testControllerFetchAllBooksReturnsStatusCodeAndContent()
    {
        $crawler = $this->client->request('GET', '/book/all');

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.books-table'));
        $this->assertSelectorTextContains('th', 'Title');
    }
}
