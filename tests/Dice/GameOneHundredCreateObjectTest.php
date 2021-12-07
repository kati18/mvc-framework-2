<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test class for class GameOneHundred.
 */
// class CreateObjectGameOneHundredTest extends TestCase
class GameOneHundredCreateObjectTest extends TestCase
{
    private $gameOneHundred;

    /**
     * Creates an instance/object of class GameOneHundredTest, no arguments.
     * Runs before every test method in the class.
     */
    protected function setUp(): void
    {
        $this->gameOneHundred = new GameOneHundred();
    }

    /**
     * Tears down/clears the instance/object of class GameOneHundredTest after
     * each method in the class has run. The object can then be collected
     * by the garbage collector.
     */
    protected function tearDown(): void
    {
        unset($this->gameOneHundred);
    }

    /**
     * Asserts new object is instance of GameOneHundredTest. Use no arguments.
     */
    public function testIsInstanceOfNoArgument1(): void
    {
        $gameOneHundred = new GameOneHundred();
        $this->assertInstanceOf(GameOneHundred::class, $gameOneHundred);
    }

    /**
     * Asserts new object is instance of GameOneHundredTest. Use no arguments.
     */
    public function testIsInstanceOfNoArgument2(): void
    {
        $this->assertInstanceOf(GameOneHundred::class, $this->gameOneHundred);
    }

    /**
     * Asserts new object is instance of GameOneHundredTest. Use no arguments.
     */
    public function testIsInstanceOfNoArgument3(): void
    {
        $gameOneHundred = new GameOneHundred();
        $this->assertInstanceOf("\App\Dice\GameOneHundred", $gameOneHundred);
        // $this->assertInstanceOf("\Kati18\Dice\GameOneHundred", $gameOneHundred);
    }

    /**
     * Asserts new object is instance of GameOneHundred. Use no arguments.
     */
    public function testIsInstanceOfNoArgument4(): void
    {
        $this->assertInstanceOf("\App\Dice\GameOneHundred", $this->gameOneHundred);
        // $this->assertInstanceOf("\Kati18\Dice\GameOneHundred", $this->gameOneHundred);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use one argument.
     */
    public function testCreateObjectFirstArgument()
    {
        $gameOneHundred = new GameOneHundred("Katja");
        $this->assertInstanceOf(GameOneHundred::class, $gameOneHundred);

        $res = $gameOneHundred->getGameRoundGame();
        $this->assertInstanceOf(GameRound::class, $res);

        $res = $gameOneHundred->getCurrentPlayerGame();
        $exp = "Katja";
        $this->assertEquals($exp, $res);

        $res = $gameOneHundred->getTotScorePlayer();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $res = $gameOneHundred->getTotScoreComputer();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. N0 argument.
     */
    public function testCreateObjectNoArgument5()
    {
        $gameOneHundred = new GameOneHundred();
        $this->assertInstanceOf(GameOneHundred::class, $gameOneHundred);

        $res = $gameOneHundred->getGameRoundGame();
        $this->assertInstanceOf(GameRound::class, $res);

        $res = $gameOneHundred->getCurrentPlayerGame();
        $exp = null;
        $this->assertEquals($exp, $res);

        $res = $gameOneHundred->getTotScorePlayer();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $res = $gameOneHundred->getTotScoreComputer();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }
}
