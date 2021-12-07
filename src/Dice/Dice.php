<?php

declare(strict_types=1);

namespace App\Dice;

/**
 * A class that contains the class Dice.
 * The class contains a method for initiating instances/objects of the class,
 * a method for rolling the die object,
 * a method for calculating the sum of all values of the rolls,
 * a method for calculation the average value of all the rolls.
*/

class Dice
{
    /**
     * @var int $sides   The number of sides of the die object
     * @var int $lastRollFace The last rolled face of the die object
     */
    private $sides;
    private $lastRollFace;
    // alt.:
    // protected $lastRollFace;


    /**
     * Constructor to initiate the die object with sides that defaults to 6 if no
     * argument is passed in.
     *
     * @param int $sides The number of sides of the die, defaults to 6.
     */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }


    // /**
    //  * Rolls the die object and randomizes a die face which is an integer between 1 and 6.
    //  */
    // public function rollDice(): void
    // {
    //     $face = rand(1, 6);
    //     $this->lastRollFace = $face;
    //     // return $this->lastRollFace; //alt below:
    //     // return $face;
    // }

    /**
     * Rolls the die object and randomizes a die face which is an integer between 1 and 6.
     * @return int as face of the last roll of the die object
     */
    public function rollDice(): int
    {
        // $face = rand(1, 6);
        $face = rand(1, $this->sides);
        $this->lastRollFace = $face;
        return $this->lastRollFace;
    }


    /**
     * Gets the face of last roll of the die object.
     *
     * @return int as face of the last roll of the die object
     */
    public function getLastRollFaceDice(): int
    {
        return $this->lastRollFace;
    }


    /**
     * Gets the face of the roll of the computer die object as soon as
     * the face of the player die object and the computer die object is
     * not equal and not of the same type.
     *
     * @param int $playerRollFace as face of init roll of the player die object
     * @param int $computerRollFace as face of init roll of the computer die object
     * @return int as face of the roll of the computer die object
     */
    public function getInitRollFaceDice(int $playerRollFace, int $computerRollFace): int
    {
        while ($playerRollFace === $computerRollFace) {
            $this->rollDice();
            $computerRollFace = $this->getLastRollFaceDice();
        }
        return $computerRollFace;
    }


    /**
     * Not in use in dice 100 in Anax!!!
     * Summarizes all values(elements) in the array $arrayValues.
     *
     * @return int as sum of all values in the array $$arrayValues.
     */
    // public function sum(array $arrayValues) : int
    // {
    //     $sum = array_sum($arrayValues);
    //     return $sum;
    // }

    /**
     * Not in use in dice 100 in Anax!!!
     * Calculates the average value of all values(elements) in the array $arrayValues.
     *
     * @return float as the average value of all values in the array $arrayValues.
     */
    // public function average(array $arrayValues) : float
    // {
    //     $sum = $this->sum($arrayValues);
    //     $average = $sum/6;
    //     return round($average, 1);
    // }
}
