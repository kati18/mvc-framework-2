<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test class for class GameOneHundred.
 */
class CreateObjectGameOneHundredExcTest extends TestCase
{
    /**
     * Construct object passing in invalid arguments(arguments of the wrong type)
     * and verify that an exception is thrown.
     */
    public function testCreateObjectWrongTypeArgument1()
    {
        $this->expectException(GameOneHundredException::class);
        // $this->expectException(InvalidArgumentException::class);

        // Below if the exception is thrown in the source code(the class):
        // $this->expectedExceptionMessage("must be of type int, string given");

        // Below if the expection is not thrown in the source code(the class):
        throw new GameOneHundredException();
        // throw new InvalidArgumentException();

        new GameOneHundred(5, "Katja", 6.7);
    }

    /**
     * Construct object passing in invalid arguments(arguments of the wrong type)
     * and verify that an exception is thrown.
     *
     * @expectedException InvalidArgumentException
     */
    public function testCreateObjectWrongTypeArgument2()
    {
        $this->expectException(GameOneHundredException::class);
        // $this->expectException(InvalidArgumentException::class);

        // Below if the exception is thrown in the source code(the class):
        // $this->expectedExceptionMessage("must be of type int, string given");

        // Below if the expection is not thrown in the source code(the class):
        throw new GameOneHundredException();
        // throw new InvalidArgumentException();

        new GameOneHundred(5, "Katja", 6.7);
    }
}
