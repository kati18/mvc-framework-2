<?php

declare(strict_types=1);

namespace App\Dice;

/**
 * A class that contains the class DiceHand.
 * A dicehand, consisting of dice.
 */
class DiceHand
{
    /**
     * @var array $dices   Array consisting of dice.
     * @var array $faces  Array consisting of the faces of the last roll of the dice.
     */
    // private array $dices;
    private $dices;
    // private array $faces;
    private $faces;

    /**
     * Constructor to initiate the dicehand with 3 dice which have 6 sides each, no values.
     *
     * @param int $dices Number of dices to create, defaults to three.
     */
    public function __construct(int $dices = 3)
    {
        $this->dices  = [];
        $this->faces = [];

        for ($i = 0; $i < $dices; $i++) {
            $this->dices[]  = new Dice();
        }
        // echo "this->dices:\n";
        // var_dump($this->dices);
        // echo "this->values:\n";
        // var_dump($this->values);
    }

    /**
     * Rolls all dice by invoking the method rollDice in class Dice.
     * Saves the faces of the dice.
     *
     * @return void
     */
    public function rollDiceHand(): void
    {
        $this->faces = [];
        foreach ($this->dices as $die) {
            $die->rollDice();
            $this->faces[] = $die->getLastRollFaceDice();
        }
    }

    /**
    * Sets the face values. Method used for unit testing only.
     */
    public function setDiceFacesDiceHand(int $face1, int $face2, int $face3, int $face4, int $face5): void
    {
        $this->faces = [$face1, $face2, $face3, $face4, $face5];
        // echo "this->faces från setDiceFacesDiceHand:\n";
        // var_dump($this->faces);
    }

    /**
     * Gets the faces of the dice from last roll.
     *
     * @return array with faces of the dice of the last roll.
     */
    public function getDiceFacesDiceHand(): array
    {
        return $this->faces;
    }

    /**
     * Gets the sum of all faces of the dice in last roll.
     *
     * @return int|float as the sum of all dice.
     */
    public function sum(): int|float
    {
        $sum = array_sum($this->faces);
        // echo "this->faces från sum():\n";
        // var_dump($this->faces);
        return $sum;
    }

    // /**
    //  * Get the average of all dice.
    //  *
    //  * @return float as the average of all faces of the dice in last roll.
    //  */
    // public function average(): float
    // {
    //     $averageValue = $this->sum()/5;
    //     return round($averageValue, 1);
    // }

    /**
     * Returns true if $this->faces contains a 1 else false.
     *
     * @return bool
     */
    public function checkIfOne(): bool
    {
        foreach ($this->faces as $face) {
            if ($face == 1) {
                return true;
            }
        } return false;
    }
}
