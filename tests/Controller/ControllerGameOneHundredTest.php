<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Dice\GameOneHundred;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

/**
 * Test class for functional testing of the class GameOneHundredController/
 * test suite for functional testing of the class GameOneHundredController.
 */
class ControllerGameOneHundredTest extends WebTestCase
{
    private $client;

    /**
     * Text fixture - to prepare before a test case
     * Runs before every test method in the class.
     */
    protected function setUp(): void
    {
        /**
         * Below row calls KernelTestCase::bootKernel() and
         * creates a "client" that is acting as the browser:
         */
        $this->client = static::createClient();
        $this->client->followRedirects();
    }


    /**
     * Testcase that asserts that the controller startGame returns:
     * - a response with correct status code
     * - a successful response
     * - a response that contains the correct content
     * - a <h1> HTML element that contains the text Katja
     * - a <h2> HTML element that contains the text game 100
     * - two <h2> HTML elements
     */
    public function testControllerStartGameReturnsStatusCodeAndContent()
    {
        $crawler = $this->client->request('GET', '/gameonehundred/');

        $this->assertNotSame(
            Response::HTTP_MOVED_PERMANENTLY,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Katja');
        $this->assertSelectorTextContains('h2', 'game 100');
        $this->assertCount(2, $crawler->filter('h2'));

        //Below row works if $this->client->followRedirects() is not active in setUp():
        // $this->assertResponseRedirects('/gameonehundred/index', 301);

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller index returns:
     * - a response with correct status code
     * - a successful response
     * - a response that contains the correct content
     * - a <title> HTML element that contains the text My Symfony App!
     * - one <p> HTML elements
     */
    public function testControllerIndexReturnsStatusCodeAndContent()
    {
        $crawler = $this->client->request('GET', '/gameonehundred/index');

        $this->assertNotSame(
            Response::HTTP_NOT_FOUND,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('title', 'My Symfony App!');
        $this->assertCount(1, $crawler->filter('p'));

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller init returns:
     * - a response with correct status code
     * - a successful response
     * - a response that contains the correct content
     * - a HTML element with attribute class="congratulation-test"
     *   that contains the text Congratulations
     * - two <h2> HTML elements
     */
    public function testControllerInitReturnsStatusCodeAndContent()
    {
        $crawler = $this->client->request('GET', '/gameonehundred/init');

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.congratulation-text', 'Congratulations');
        $this->assertCount(2, $crawler->filter('h2'));

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller initRoll returns:
     * - a response with correct status code
     * - a successful response
     * - a response that contains the correct content
     * - a <h2> HTML element that contains the text "game 100"
     * - a HTML element with attribute class="congratulation-test"
     *   that contains the text Congratulations
     * - four <p> HTML elements
     */
    public function testControllerInitRollReturnsStatusCodeAndContent()
    {
        $crawler = $this->client->request('GET', '/gameonehundred/init-roll');

        $this->assertNotSame(
            Response::HTTP_FOUND,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'game 100');
        $this->assertSelectorTextContains('.congratulation-text', 'Congratulations');
        $this->assertCount(4, $crawler->filter('p'));

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller play returns:
     * - a response with correct status code
     * - a successful response
     * - a response that contains the correct content
     * - a HTML element with attribute class="congratulation-test"
     *   that contains the text Congratulations
     * - two <h2> HTML elements
     */
    public function testControllerPlayReturnsStatusCodeAndContent()
    {
        /** Test 211101 kl 15:05 and according to:
         * https://stackoverflow.com/questions/11514490/symfony-2-adding-session-data-to-request-object-during-unit-testing
         */
        $sessionObj = $this->client->getContainer()->get('session');
        $sessionObj->set('gameOneHundred', new GameOneHundred(currentPlayer: 'Katja'));
        //End test 211101 kl 15:05

        $crawler = $this->client->request('GET', '/gameonehundred/play');

        $this->assertNotSame(
            Response::HTTP_FOUND,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('.current-player', 'Player: Katja');
        $this->assertCount(2, $crawler->filter('h2'));
        $this->assertSelectorTextContains('button', 'Roll again');

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller save returns:
     * - a response with correct status code
     * - a successful response
     */
    public function testControllerSaveReturnsStatusCodeAndContent()
    {
        // Below row calls KernelTestCase::bootKernel() and
        // creates a "client" that is acting as the browser:
        // $client = static::createClient();

        /** Test 211101 kl 15:05 and according to:
         * https://stackoverflow.com/questions/11514490/symfony-2-adding-session-data-to-request-object-during-unit-testing
         */
        $sessionObj = $this->client->getContainer()->get('session');
        $sessionObj->set('gameOneHundred', new GameOneHundred(currentPlayer: 'Katja'));
        //End test 211101 kl 15:05

        $crawler = $this->client->request('GET', '/gameonehundred/save');

        $this->assertNotSame(
            Response::HTTP_FOUND,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller initPlayComputer returns:
     * - a response with correct status code
     * - a successful response
     */
    public function testControllerInitPlayComputerReturnsStatusCodeAndContent()
    {
        /** Test 211101 kl 15:05 and according to:
         * https://stackoverflow.com/questions/11514490/symfony-2-adding-session-data-to-request-object-during-unit-testing
         */
        $sessionObj = $this->client->getContainer()->get('session');
        $sessionObj->set('gameOneHundred', new GameOneHundred(currentPlayer: 'Katja'));
        //End test 211101 kl 15:05

        $crawler = $this->client->request('GET', '/gameonehundred/init-play-computer');

        $this->assertNotSame(
            Response::HTTP_FOUND,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller playComputer returns:
     * - a response with correct status code
     * - a successful response
     */
    public function testControllerPlayComputerReturnsStatusCodeAndContent()
    {
        /** Test 211101 kl 15:05 and according to:
         * https://stackoverflow.com/questions/11514490/symfony-2-adding-session-data-to-request-object-during-unit-testing
         */
        $sessionObj = $this->client->getContainer()->get('session');
        $sessionObj->set('gameOneHundred', new GameOneHundred(currentPlayer: 'Katja'));
        //End test 211101 kl 15:05

        $crawler = $this->client->request('GET', '/gameonehundred/play-computer');

        $this->assertNotSame(
            Response::HTTP_FOUND,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller win returns:
     * - a response with correct status code
     * - a successful response
     */
    public function testControllerWinReturnsStatusCodeAndContent()
    {
        /** Test 211101 kl 15:05 and according to:
         * https://stackoverflow.com/questions/11514490/symfony-2-adding-session-data-to-request-object-during-unit-testing
         */
        $sessionObj = $this->client->getContainer()->get('session');
        $sessionObj->set('gameOneHundred', new GameOneHundred(currentPlayer: 'Katja'));
        //End test 211101 kl 15:05

        $crawler = $this->client->request('GET', '/gameonehundred/win');

        $this->assertNotSame(
            Response::HTTP_FOUND,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();

        // unset($client);
    }

    /**
     * Testcase that asserts that the controller restartInit returns:
     * - a response with correct status code
     * - a successful response
     */
    public function testControllerRestartInitReturnsStatusCodeAndContent()
    {
        /** Test 211101 kl 15:05 and according to:
         * https://stackoverflow.com/questions/11514490/symfony-2-adding-session-data-to-request-object-during-unit-testing
         */
        $sessionObj = $this->client->getContainer()->get('session');
        $sessionObj->set('gameOneHundred', new GameOneHundred(currentPlayer: 'Katja'));
        //End test 211101 kl 15:05

        $crawler = $this->client->request('GET', '/gameonehundred/restart-init');

        $this->assertNotSame(
            Response::HTTP_FOUND,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertSame(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->assertResponseIsSuccessful();

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
