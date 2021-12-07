<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test class for class Dice.
 */
class GameRoundTest extends TestCase
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

    public function testSetInitCurrentPlayer1(): void
    {
        $this->gameRound->setInitCurrentPlayer(5, 3);
        $exp = "You";
        $notExp = "Computer";
        $res = $this->gameRound->getCurrentPlayer();

        $this->assertEquals($exp, $res);
        $this->assertNotEquals($notExp, $res);
    }

    public function testSetInitCurrentPlayer2(): void
    {
        $this->gameRound->setInitCurrentPlayer(3, 5);
        $exp = "Computer";
        $notExp = "You";
        $res = $this->gameRound->getCurrentPlayer();

        $this->assertEquals($exp, $res);
        $this->assertNotEquals($notExp, $res);
    }

    public function testSetRoundScoreGameRoundToZero(): void
    {
        $this->gameRound->setRoundScoreGameRoundToZero();
        $exp = 0;
        $res = $this->gameRound->getRoundScoreGameRound();

        $this->assertEquals($exp, $res);
    }

    public function testGetCurrentPlayer1(): void
    {
        $gameRound = new GameRound("Katja");
        $res = $gameRound->getCurrentPlayer();
        $exp = "Katja";

        $this->assertEquals($exp, $res);
    }

    public function testGetCurrentPlayer2(): void
    {
        $gameRound = new GameRound("Computer");
        $res = $gameRound->getCurrentPlayer();
        $exp = "Computer";

        $this->assertEquals($exp, $res);
    }

    public function testSetRoundScoreGameRound1(): void
    {
        $gameRound = new GameRound("Katja");

        $exp;
        $gameRound->rollGameRound();
        $diceArray = $gameRound->getDiceFacesGameRound();

        (in_array(1, $diceArray)) ?
            $exp = 0 :
            $exp = $gameRound->getSumGameRound(); // alt. below row:

        // if (in_array(1, $diceArray)) {
        //     $exp = 0;
        // } else {
        //     $exp = $gameRound->getSumGameRound(); // alt. below row:
        //     // $exp = array_sum($diceArray);
        // }

        $gameRound->setRoundScoreGameRound();
        $res = $gameRound->getRoundScoreGameRound();

        $this->assertEquals($exp, $res);
    }

    public function testSetRoundScoreGameRound2(): void
    {
        $gameRound = new GameRound("Katja");

        $gameRound->rollGameRound();
        $diceArray = $gameRound->getDiceFacesGameRound();

        $exp;
        (!in_array(1, $diceArray)) ?
            $exp = $gameRound->getSumGameRound() : // alt. below row:
            // $exp = array_sum($diceArray);
            $exp = 0;

        // $exp;
        // if (!in_array(1, $diceArray)) {
        //     $exp = $gameRound->getSumGameRound(); // alt. below row:
        //     // $exp = array_sum($diceArray);
        // } else {
        //     $exp = 0;
        // }

        $gameRound->setRoundScoreGameRound();
        $res = $gameRound->getRoundScoreGameRound();

        $this->assertEquals($exp, $res);
    }
}
