<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Controller\BookController;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Test class for unit testing class BookController/
 * test suite for unit testing class BookController.
 */
class ControllerBookReturnsResponseTest extends KernelTestCase
{
    private $bookControllerObj;
    private $bookRepositoryObj;

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

        $this->bookControllerObj = $container->get(BookController::class);
        $this->bookRepositoryObj = $container->get(BookRepository::class);
    }

    /**
     * Testcase to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $this->assertInstanceOf(BookController::class, $this->bookControllerObj);
    }

    /**
     * Testcase that asserts that the controller index returns a response.
     */
    public function testControllerIndexReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        $res = $this->bookControllerObj->index();
        // echo "res från testControllerIndexReturnsResponse:\n";
        // echo $res;
        // var_dump($res);
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Testcase that asserts that the controller fetchAllBooks returns a response.
     */
    public function testControllerfetchAllBooksReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerfetchAllBooksReturnsResponse:\n";
        // echo $exp;

        $res = $this->bookControllerObj->fetchAllBooks(bookRepository: $this->bookRepositoryObj);
        // echo "res från testControllerfetchAllBooksReturnsResponse:\n";
        // echo $res;
        // var_dump($res);
        $this->assertInstanceOf($exp, $res);
    }
}
