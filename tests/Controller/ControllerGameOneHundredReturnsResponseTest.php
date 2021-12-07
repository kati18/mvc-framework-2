<?php

declare(strict_types=1);

// namespace App\Controller;

// use PHPUnit\Framework\TestCase;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

namespace App\Tests\Controller;

use App\Controller\GameOneHundredController;
use App\Dice\GameOneHundred;
// use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

/**
 * Test class for unit testing class GameOneHundredController/test suite for
 * unit testing class GameOneHundredController.
 */
class ControllerGameOneHundredReturnsResponseTest extends KernelTestCase
{
    private $gameOneHundredControllerObj;
    private $requestObj;
    private $requestStackObj;
    private $sessionObj;

    /**
     * Text fixture - to prepare before a test case
     * Runs before every test method in the class.
     * Below row 47 calls KernelTestCase::bootKernel()
     */
    protected function setUp(): void
    {
        /**
         * Below row boots the Symfony kernel by
         * executing the static method bootKernel in class KernelTestCase:
         */
        self::bootKernel();
        // alt.:
        // 'Symfony\Bundle\FrameworkBundle\Test\KernelTestCase'::bootKernel();

        $this->requestObj = new Request();
        $this->requestObj->setSession(new Session(new MockArraySessionStorage()));
        $this->sessionObj = $this->requestObj->getSession();
        $this->sessionObj->set('gameOneHundred', new GameOneHundred());

        $this->requestStackObj = new RequestStack();
        $this->requestStackObj->push($this->requestObj);

        $this->gameOneHundredControllerObj = new GameOneHundredController(requestStack: $this->requestStackObj);

        /**
         * static::$container below is the
         * static Symfony\Bundle\FrameworkBundle\Test\KernelTestCase::$container:
         */
        $this->gameOneHundredControllerObj->setContainer(static::$container);
    }

    /**
     * Testcase to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $this->assertInstanceOf(GameOneHundredController::class, $this->gameOneHundredControllerObj);
        // $this->assertObjectHasAttribute('message', $this->gameOneHundredControllerObj);
        // $this->assertClassHasAttribute('message', '\App\Controller\GameOneHundredController');
        $this->assertObjectHasAttribute('requestStack', $this->gameOneHundredControllerObj);
        $this->assertClassHasAttribute('requestStack', '\App\Controller\GameOneHundredController');

        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller startGame returns a response.
     */
    public function testControllerStartGameReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\RedirectResponse";
        // alt. below row:
        // $exp = RedirectResponse::class;

        // echo "exp från testControllerStartGameReturnsResponse:\n";
        // echo $exp;

        $res = $this->gameOneHundredControllerObj->startGame();
        // echo "res från testControllerStartGameReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller index returns a response.
     */
    public function testControllerIndexReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerIndexReturnsResponse:\n";
        // echo $exp;

        $res = $this->gameOneHundredControllerObj->index();
        // echo "res från testControllerIndexReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller init returns a response.
     */
    public function testControllerInitReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerInitReturnsResponse:\n";
        // echo $exp;
        $res = $this->gameOneHundredControllerObj->init();
        // echo "res från testControllerInitReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller initRoll returns a response.
     */
    public function testControllerInitRollReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerInitRollReturnsResponse:\n";
        // echo $exp;
        $res = $this->gameOneHundredControllerObj->initRoll();
        // echo "res från testControllerInitRollReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller play returns a response.
     */
    public function testControllerPlayReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerPlayReturnsResponse:\n";
        // echo $exp;
        $res = $this->gameOneHundredControllerObj->play();
        // echo "res från testControllerPlayReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller save returns a response.
     */
    public function testControllerSaveReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerSaveReturnsResponse:\n";
        // echo $exp;
        $res = $this->gameOneHundredControllerObj->save();
        // echo "res från testControllerSaveReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller save returns a response.
     */
    public function testControllerSaveReturnsResponseArg()
    {
        $this->sessionObj->set('gameOneHundred', new GameOneHundred(totScorePlayer: 101));

        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerSaveReturnsResponse:\n";
        // echo $exp;
        $res = $this->gameOneHundredControllerObj->save();
        // echo "res från testControllerSaveReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller initPlayComputer returns a response.
     */
    public function testControllerInitPlayComputerReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerInitPlayComputerReturnsResponse:\n";
        // echo $exp;
        $res = $this->gameOneHundredControllerObj->initPlayComputer();
        // echo "res från testControllerInitPlayComputerReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller playComputer returns a response.
     */
    public function testControllerPlayComputerReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerPlayComputerReturnsResponse:\n";
        // echo $exp;
        $res = $this->gameOneHundredControllerObj->playComputer();
        // echo "res från testControllerPlayComputerReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller win returns a response.
     */
    public function testControllerWinReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerWinReturnsResponse:\n";
        // echo $exp;
        $res = $this->gameOneHundredControllerObj->win();
        // echo "res från testControllerWinReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }

    /**
     * Testcase that asserts that the controller restartInit returns a response.
     */
    public function testControllerRestartInitReturnsResponse()
    {
        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerRestartInitReturnsResponse:\n";
        // echo $exp;
        $res = $this->gameOneHundredControllerObj->restartInit();
        // echo "res från testControllerRestartInitReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }


    /**
     * Testcase that asserts that the controller gameWcard returns a response.
     */
    public function testControllerGameWcardReturnsResponse()
    {
        $this->requestObj->attributes->set('_route_params', 'katja');
        // echo "route_params: \n";
        // echo $requestObj->attributes->get('_route_params');

        $exp = "\Symfony\Component\HttpFoundation\Response";
        //alt. below row:
        // $exp = Response::class;

        // echo "exp från testControllerGameWcardReturnsResponse:\n";
        // echo $exp;
        $res = $this->gameOneHundredControllerObj->gameWcard('katja');
        // echo "res från testControllerGameWcardReturnsResponse:\n";
        // echo $res;
        // var_dump($res);

        $this->assertInstanceOf($exp, $res);
        // unset($this->gameOneHundredControllerObj);
    }
}
