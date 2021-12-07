<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test class for class GameRound.
 */
class GameRoundCreateObjectTest extends TestCase
{
    private $gameRound;

    /**
     * Creates an instance/object of class GameRound, no arguments.
     * Runs before every test method in the class.
     */
    protected function setUp(): void
    {
        $this->gameRound = new GameRound(null);
    }

    /**
     * Tears down/clears the instance/object of class GameRound after
     * each method in the class has run. The object can then be collected
     * by the garbage collector.
     */
    protected function tearDown(): void
    {
        unset($this->gameRound);
    }

    /**
     * Asserts new object is instance of GameRound. Use argument.
     */
    public function testIsInstanceOfArgument1(): void
    {
        $gameRound = new GameRound(null);
        $this->assertInstanceOf(GameRound::class, $gameRound);
    }

    /**
     * Asserts new object is instance of GameRound. Use no arguments.
     */
    public function testIsInstanceOfNoArgument2(): void
    {
        $this->assertInstanceOf(GameRound::class, $this->gameRound);
    }

    /**
     * Asserts new object is instance of GameRound. Use argument.
     */
    public function testIsInstanceOfNoArgument3(): void
    {
        $gameRound = new GameRound(null);
        $this->assertInstanceOf("\App\Dice\GameRound", $gameRound);
        // $this->assertInstanceOf("\Kati18\Dice\GameRound", $gameRound);
    }

    /**
     * Asserts new object is instance of GameRound. Use no arguments.
     */
    public function testIsInstanceOfNoArgument4(): void
    {
        $this->assertInstanceOf("\App\Dice\GameRound", $this->gameRound);
        // $this->assertInstanceOf("\Kati18\Dice\GameRound", $this->gameRound);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use one argument.
     */
    public function testCreateObjectFirstArgument()
    {
        $gameRound = new GameRound("Katja");
        $this->assertInstanceOf("\App\Dice\GameRound", $gameRound);
        // $this->assertInstanceOf("\Kati18\Dice\GameRound", $gameRound);

        $res = $gameRound->getDiceHandGameRound();
        $this->assertInstanceOf(DiceHand::class, $res);

        $res = $gameRound->getCurrentPlayer();
        $exp = "Katja";
        $this->assertEquals($exp, $res);

        $res = $gameRound->getRoundScoreGameRound();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }
}
