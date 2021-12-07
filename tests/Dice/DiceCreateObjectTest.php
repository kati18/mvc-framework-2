<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test class for class Dice.
 */
class DiceCreateObjectTest extends TestCase
{
    private $die;

    /**
     * Creates an instance/object of class Dice, no arguments.
     * Runs before every test method in the class.
     */
    protected function setUp(): void
    {
        $this->die = new Dice();
    }

    /**
     * Tears down/clears the instance/object of class Dice after
     * each method in the class has run. The object can then be collected
     * by the garbage collector.
     */
    protected function tearDown(): void
    {
        unset($this->die);
    }

    /**
     * Asserts new object is instance of Dice. Use no arguments.
     */
    public function testIsInstanceOfNoArgument1(): void
    {
        $die = new Dice();
        $this->assertInstanceOf(Dice::class, $die);
    }

    /**
     * Asserts new object is instance of Dice. Use no arguments.
     */
    public function testIsInstanceOfNoArgument2(): void
    {
        $this->assertInstanceOf(Dice::class, $this->die);
    }

    /**
     * Asserts new object is instance of Dice. Use no arguments.
     */
    public function testIsInstanceOfNoArgument3(): void
    {
        $die = new Dice();
        $this->assertInstanceOf("\App\Dice\Dice", $die);
        // $this->assertInstanceOf("\Kati18\Dice\Dice", $die);
    }

    /**
     * Asserts new object is instance of Dice. Use no arguments.
     */
    public function testIsInstanceOfNoArgument4(): void
    {
        $this->assertInstanceOf("\App\Dice\Dice", $this->die);
        // $this->assertInstanceOf("\Kati18\Dice\Dice", $this->die);
    }
}
