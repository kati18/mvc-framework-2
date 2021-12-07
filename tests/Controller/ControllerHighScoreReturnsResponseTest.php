<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Controller\HighScoreController;
use App\Repository\HighScoreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Test class for unit testing class HighScoreController/
 * test suite for unit testing class HighScoreController.
 */
class ControllerHighScoreReturnsResponseTest extends KernelTestCase
{
    private $highScoreControllerObj;
    private $highScoreRepositoryObj;

    /**
     * Text fixture - to prepare before a test case
     * Runs before every test method in the class.
     * Below row 38 calls KernelTestCase::bootKernel() and
     * creates a "client" that is acting as the browser:
     */
    protected function setUp(): void
    {
        /**
         * Below row boots the Symfony kernel by
         * executing the static method bootKernel in class KernelTestCase:
         */
        self::bootKernel();

        /** Below(done by executing the static method getContainer in class
         * KernelTestCase (I think)) row to access the special test service
         * container which contains both the public services as well as
         * non-removed private services:
         */
        $container = static::getContainer();

        $this->highScoreControllerObj = $container->get(HighScoreController::class);
        $this->entityManagerObj = $container->get(EntityManagerInterface::class);
        $this->highScoreRepositoryObj = $container->get(HighScoreRepository::class);
    }

    /**
     * Testcase to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $this->assertInstanceOf(HighScoreController::class, $this->highScoreControllerObj);
    }

    /**
     * Testcase that asserts that the controller createHighScore returns a response.
     */
    public function testControllerCreateHighScoreReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerfetchAllBooksReturnsResponse:\n";
        // echo $exp;

        $res = $this->highScoreControllerObj->createHighScore(
            score: 108,
            winner: "Player",
            entityManager: $this->entityManagerObj
        );
        // echo "res från testControllerCreateHighScoreReturnsResponse:\n";
        // echo $res;
        // var_dump($res);
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Testcase that asserts that the controller fetchAllHighScores returns a response.
     */
    public function testControllerfetchAllHighScoresReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerfetchAllBooksReturnsResponse:\n";
        // echo $exp;

        $res = $this->highScoreControllerObj->fetchAllHighScores(highScoreRepository: $this->highScoreRepositoryObj);
        // echo "res från testControllerfetchAllBooksReturnsResponse:\n";
        // echo $res;
        // var_dump($res);
        $this->assertInstanceOf($exp, $res);
    }
}
