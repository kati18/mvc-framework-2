<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Test class for functional testing of class HighScoreController/
 * test suite for functional testing of class HighScoreController.
 */
class ControllerHighScoreTest extends WebTestCase
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
     * Testcase that asserts that the controller createHighScore returns:
     * - a response with correct status code
     * - a successful response
     */
    public function testControllerCreateHighScoreReturnsStatusCodeAndContent()
    {
        $crawler = $this->client->request('GET', '/high-score/create/108/Player');

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
    }

    /**
     * Testcase that asserts that the controller fetchAllHighScores returns:
     * - a response with correct status code
     * - a successful response
     * - a HTML element with attribute class="high-scores-table"
     * - a <table> HTML element
     * - two <h1> HTML elements
     */
    public function testControllerFetchAllHighScoresReturnsStatusCodeAndContent()
    {
        $crawler = $this->client->request('GET', '/high-score/find/all');

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertCount(1, $crawler->filter('.high-scores-table'));
        $this->assertCount(1, $crawler->filter('table'));
        $this->assertCount(2, $crawler->filter('h1'));
    }
}
