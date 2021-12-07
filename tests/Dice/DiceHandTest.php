<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test class for class DiceHand.
 */
class DiceHandTest extends TestCase
{
    private $diceHand;

    /**
     * Creates an instance/object of class DiceHand, no arguments.
     * Runs before every test method in the class.
     */
    protected function setUp(): void
    {
        $this->diceHand = new DiceHand();
    }

    /**
     * Tears down/clears the instance/object of class DiceHand after
     * each method in the class has run. The object can then be collected
     * by the garbage collector.
     */
    protected function tearDown(): void
    {
        unset($this->diceHand);
    }


    /**
     * Asserts that correct amount of dice are created when a
     * new instance/object of class DiceHand is created.
     */
    public function testRollDiceHand(): void
    {
        $diceHand = new DiceHand(5);
        $diceHand->rollDiceHand();
        $res = count($diceHand->getDiceFacesDiceHand());
        $exp = 5;

        $this->assertEquals($exp, $res);
    }

    /**
     * Asserts the method sum when dice are rolled.
     * Asserts that the sum of all dice faces is correctly calculated.
     */
    public function testSum1(): void
    {
        $this->diceHand->rollDiceHand();
        $exp = array_sum($this->diceHand->getDiceFacesDiceHand());
        $res = $this->diceHand->sum();

        $this->assertEquals($exp, $res);
    }

    /**
     * Asserts the method sum with given faces of the dice i e
     * when the dice are not rolled.
     * Asserts that the sum of all dice faces is correctly calculated.
     */
    public function testSum2(): void
    {
        $diceHand = new DiceHand(5);
        $diceHand->setDiceFacesDiceHand(5, 2, 4, 3, 1);

        $exp = 15;
        $res = $diceHand->sum();

        $this->assertEquals($exp, $res);
    }

    /**
     * Asserts the method checkIfOne and its return value.
     */
    public function testCheckIfOne(): void
    {
        $exp;
        $this->diceHand->rollDiceHand();
        $diceArray = $this->diceHand->getDiceFacesDiceHand();

        (in_array(1, $diceArray)) ?
            $exp = true :
            $exp = false;

        // if (in_array(1, $diceArray)) {
        //     $exp = true;
        // } else {
        //     $exp = false;
        // }

        $res = $this->diceHand->checkIfOne();

        $this->assertEquals($exp, $res);
    }

    // /**
    //  * Asserts the method average with given faces of the dice i e
    //  * when the dice are not rolled.
    //  * Asserts that the average value of all dice faces is correctly calculated.
    //  */
    // public function testAverage(): void
    // {
    //     $diceHand = new DiceHand(5);
    //     $diceHand->setDiceFacesDiceHand(5, 2, 4, 3, 1);
    //     $exp = 3.0;
    //     $notExp = 3.8;
    //     $res = $diceHand->average();
    //
    //     $this->assertNotEquals($notExp, $res);
    //     $this->assertEquals($exp, $res);
    // }
}
