<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test class for class GameOneHundred.
 */
class GameOneHundredTest extends TestCase
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

    public function testSetInitCurrPlayerGame1(): void
    {
        $this->gameOneHundred->setInitCurrPlayerGame(5, 3);
        $exp = "You";
        $notExp = "Computer";
        $res = $this->gameOneHundred->getCurrentPlayerGame();

        $this->assertEquals($exp, $res);
        $this->assertNotEquals($notExp, $res);
    }

    public function testSetInitCurrPlayerGame2(): void
    {
        $this->gameOneHundred->setInitCurrPlayerGame(3, 5);
        $exp = "Computer";
        $notExp = "You";
        $res = $this->gameOneHundred->getCurrentPlayerGame();

        $this->assertEquals($exp, $res);
        $this->assertNotEquals($notExp, $res);
    }

    public function testCreateNewGameRoundGame(): void
    {
        $this->gameOneHundred->createNewGameRoundGame("Pelle");
        $res = $this->gameOneHundred->getGameRoundGame();
        $this->assertInstanceOf(GameRound::class, $res);
    }

    public function testChangeCurrentPlayerGame1(): void
    {
        $gameOneHundred = new GameOneHundred("You");
        $gameOneHundred->changeCurrentPlayerGame();
        $exp = "Computer";
        $res = $gameOneHundred->getCurrentPlayerGame();

        $this->assertEquals($exp, $res);
    }

    public function testChangeCurrentPlayerGame2(): void
    {
        $gameOneHundred = new GameOneHundred("Computer");
        $gameOneHundred->changeCurrentPlayerGame();
        $exp = "You";
        $res = $gameOneHundred->getCurrentPlayerGame();

        $this->assertEquals($exp, $res);
    }

    public function testSetTotScoreGame1(): void
    {
        $gameOneHundred = new GameOneHundred("You");

        $gameOneHundred->rollGame();
        $diceArray = $gameOneHundred->getDiceFacesGame();
        // echo "diceArray från metod testSetTotScoreGame1:\n";
        // var_dump($diceArray);

        $exp;
        (!in_array(1, $diceArray)) ?
            $exp = array_sum($diceArray) :
            $exp = 0;

        // if (!in_array(1, $diceArray)) {
        //     $exp = array_sum($diceArray);
        // } else {
        //     $exp = 0;
        // }

        $gameOneHundred->setRoundScoreGame();
        $gameOneHundred->setTotScoreGame();
        $res = $gameOneHundred->getTotScorePlayer();
        // echo "res från metod testSetTotScoreGame1:\n";
        // var_dump($res);

        $this->assertEquals($exp, $res);
    }

    public function testSetTotScoreGame2(): void
    {
        $gameOneHundred = new GameOneHundred("Computer");

        $gameOneHundred->rollGame();
        $diceArray = $gameOneHundred->getDiceFacesGame();

        $exp;
        (!in_array(1, $diceArray)) ?
            $exp = array_sum($diceArray) :
            $exp = 0;

        // if (!in_array(1, $diceArray)) {
        //     $exp = array_sum($diceArray);
        // } else {
        //     $exp = 0;
        // }

        $gameOneHundred->setRoundScoreGame();
        $gameOneHundred->setTotScoreGame();
        $res = $gameOneHundred->getTotScoreComputer();

        $this->assertEquals($exp, $res);
    }

    public function testGameOver1(): void
    {
        $gameOneHundred = new GameOneHundred("Computer", 101, 29);

        $exp = "The computer won the dice game!";
        $res = $gameOneHundred->gameOver();

        $this->assertEquals($exp, $res);
    }

    public function testGameOver2(): void
    {
        $gameOneHundred = new GameOneHundred("You", 29, 101);

        $exp = "You won the dice game!";
        $res = $gameOneHundred->gameOver();

        $this->assertEquals($exp, $res);
    }

    public function testGameOver3(): void
    {
        $gameOneHundred = new GameOneHundred("You", 0, 0);

        $exp = null;
        $res = $gameOneHundred->gameOver();

        $this->assertEquals($exp, $res);
    }

    public function testComputerPlay1(): void
    {
        $gameOneHundred = new GameOneHundred("Computer");
        $res = $gameOneHundred->computerPlay();
        // var_dump($res);

        $diceArray = $gameOneHundred->getDiceFacesGame();
        // var_dump($diceArray);

        // if (in_array(1, $diceArray)) {
        //     $exp = "The computer got no points!";
        // } else {
        //     $exp = "The computer got points!";
        // }

        (in_array(1, $diceArray)) ?
            $exp = "The computer got no points!" :
            // $exp = "The computer got points!";
            $exp = "The computer is done playing its gameround!";

        $this->assertEquals($exp, $res);
    }

    // public function testComputerPlay2(): void
    // {
    //     $gameOneHundred = new GameOneHundred("Computer");
    //     $res = $gameOneHundred->computerPlay();
    //     // var_dump($res);
    //
    //     $diceArray = $gameOneHundred->getDiceFacesGame();
    //     // var_dump($diceArray);
    //
    //     if (in_array(1, $diceArray)) {
    //         $exp = "The computer got no points!";
    //     } else {
    //         $exp = "The computer got points!";
    //     }
    //
    //     $this->assertEquals($exp, $res);
    // }

    public function testComputerPlay3(): void
    {
        $gameOneHundred = new GameOneHundred("Computer");
        $res = $gameOneHundred->computerPlay(15, 10);
        // var_dump($res);

        $exp = "The computer is done playing its gameround!";

        $this->assertEquals($exp, $res);
    }
}
