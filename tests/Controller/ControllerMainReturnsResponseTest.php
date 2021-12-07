<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Controller\MainController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Test class for unit testing class MainController/
 * test suite for unit testing class MainController.
 */
class ControllerMainReturnsResponseTest extends KernelTestCase
{
    private $mainControllerObj;

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

        $this->mainControllerObj = $container->get(MainController::class);
    }

    /**
     * Testcase to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $this->assertInstanceOf(MainController::class, $this->mainControllerObj);
        // $this->assertObjectHasAttribute('message', $this->mainControllerObj);
        // $this->assertClassHasAttribute('message', '\App\Controller\MainController');

        // unset($this->mainControllerObj);
    }

    /**
     * Testcase that asserts that the controller start returns a response.
     */
    public function testControllerStartReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        $res = $this->mainControllerObj->index();
        // echo "res från testControllerStartReturnsResponse:\n";
        // echo $res;
        // var_dump($res);
        $this->assertInstanceOf($exp, $res);
        // unset($this->mainControllerObj);
    }

    /**
     * Testcase that asserts that the controller me returns a response.
     */
    public function testControllerMeReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerReturnsResponse:\n";
        // echo $exp;

        $res = $this->mainControllerObj->me();
        // echo "res från testControllerReturnsResponse:\n";
        // echo $res;
        // var_dump($res);
        $this->assertInstanceOf($exp, $res);
        // unset($this->mainControllerObj);
    }

    /**
     * Testcase that asserts that the controller about returns a response.
     */
    public function testControllerAboutReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerReturnsResponse:\n";
        // echo $exp;

        $res = $this->mainControllerObj->about();
        // echo "res från testControllerReturnsResponse:\n";
        // echo $res;
        // var_dump($res);
        $this->assertInstanceOf($exp, $res);
        unset($this->mainControllerObj);
    }


    /**
     * Testcase that asserts that the controller invalidPath returns a response.
     */
    public function testControllerInvalidPathReturnsResponse()
    {
        $requestObj = new Request();
        $requestObj->attributes->set('_route_params', 'katja');
        // echo "route_params: \n";
        // echo $requestObj->attributes->get('_route_params');

        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerInvalidPathReturnsResponse:\n";
        // echo $exp;

        $res = $this->mainControllerObj->invalidPath(request: $requestObj, invalidPath: 'katja');
        // echo "res från testControllerInvalidPathReturnsResponse:\n";
        // echo $res;
        // var_dump($res);
        $this->assertInstanceOf($exp, $res);
        unset($this->mainControllerObj);
    }
}
