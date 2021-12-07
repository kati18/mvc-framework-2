<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test class for class DiceHand.
 */
class DiceHandCreateObjectTest extends TestCase
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
     * Asserts that new object is instance of DiceHand. Use no arguments.
     */
    public function testIsInstanceOfNoArgument1(): void
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf(DiceHand::class, $diceHand);
    }

    /**
     * Asserts that new object is instance of DiceHand. Use no arguments.
     */
    public function testIsInstanceOfNoArgument2(): void
    {
        $this->assertInstanceOf(DiceHand::class, $this->diceHand);
    }

    /**
     * Asserts that new object is instance of DiceHand. Use no arguments.
     */
    public function testIsInstanceOfNoArgument3(): void
    {
        $diceHand = new DiceHand();
        $this->assertInstanceOf("\App\Dice\DiceHand", $diceHand);
        // $this->assertInstanceOf("\Kati18\Dice\DiceHand", $diceHand);
    }

    /**
     * Asserts that new object is instance of DiceHand. Use no arguments.
     */
    public function testIsInstanceOfNoArgument4(): void
    {
        $this->assertInstanceOf("\App\Dice\DiceHand", $this->diceHand);
        // $this->assertInstanceOf("\Kati18\Dice\DiceHand", $this->diceHand);
    }
}
