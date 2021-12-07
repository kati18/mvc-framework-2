<?php

declare(strict_types=1);

namespace App\Dice;

/**
 * A class that contains the class GameRound.
 * The class contains a method for initiating instances/objects of the class.
 * a method for setting the initial current player,
 * a method for getting the current player,
 * a method for getting the round score,
 * a method for getting the facevalues,
 * a method for rolling the dice.
*/

class GameRound
{
    /**
     * @var string|null $currentPlayer  The current player
     * @var DiceHand $diceHand          The object of class DiceHand
     * @var int $roundScore             The saved score during a gameround (up till the score 100 or more)
     */
    private ?string $currentPlayer;
    private $diceHand;
    private $roundScore;


    /**
     * Constructor for initiating an object of the class GameRound
     * @param string|null $currentPlayer
     * @return void
     */
    public function __construct(?string $currentPlayer)
    {
        $this->diceHand = new DiceHand();
        $this->currentPlayer = $currentPlayer;
        $this->roundScore = 0;
    }


    /**
     * Sets the initial current player after the initial roll a single die
     *
     * @param int $playerRes
     * @param int $computerRes
     * @return void
     */
    // public function setInitCurrentPlayer(int $playerRes, int $computerRes): void
    // {
    //     if ($playerRes > $computerRes) {
    //         $this->currentPlayer = "You";
    //     } else {
    //         $this->currentPlayer = "Computer";
    //     }
    // }

    public function setInitCurrentPlayer(int $playerRes, int $computerRes): void
    {
        $playerRes > $computerRes ?
            $this->currentPlayer = "You" :
            $this->currentPlayer = "Computer";
    }


    /**
     * Returns the current player
     *
     * @return string|null as the current player
     */
    public function getCurrentPlayer(): ?string
    {
        return $this->currentPlayer;
    }

    /**
    * Gets the dicehand object
    * Method used for unit testing only.
    *
    * @return DiceHand The diceHand object
    */
    public function getDiceHandGameRound(): DiceHand
    {
        return $this->diceHand;
    }


    /**
    * Rolls the dice by invoking method rollDiceHand in class DiceHand
    *
    * @return void
    */
    public function rollGameRound(): void
    {
        // echo "this->diceHand från metod rollGameRound:\n";
        // var_dump($this->diceHand);
        $this->diceHand->rollDiceHand();
    }


    /**
    * Returns the facevalues of the rolled dice by invoking
    * the method getDiceFacesDiceHand in class DiceHand
    *
    * @return array as facevalues of the rolled dice
    */
    public function getDiceFacesGameRound(): array
    {
        return $this->diceHand->getDiceFacesDiceHand();
    }


    /**
    * Returns the sum of the facevalues of the rolled dice by invoking
    * the method sum in class DiceHand. Method used for unit testing only.
    *
    * @return int|float as the sum of the facevalues of the rolled dice
    */
    public function getSumGameRound(): int|float
    {
        return $this->diceHand->sum();
    }


    /**
     * Sets the round score of a game round
     * The round score is set to 0 if the face of one or more
     * die is a "1" else it is set to the sum of all rolls
     */
    // public function setRoundScoreGameRound(): void
    // {
    //     if ($this->diceHand->checkIfOne()) {
    //         $this->roundScore = 0;
    //     } else {
    //         $this->roundScore = $this->roundScore + $this->diceHand->sum();
    //     }
    // }

    public function setRoundScoreGameRound(): void
    {
        $this->diceHand->checkIfOne() ?
            $this->roundScore = 0 :
            $this->roundScore = $this->roundScore + $this->diceHand->sum();
    }


    /**
    * Sets the round score of a game round to 0(zero)
    */
    public function setRoundScoreGameRoundToZero(): void
    {
        $this->roundScore = 0;
    }


    /**
     * Returns the round score of a game round
     *
     * @return int as the round score of a gameround
     */
    public function getRoundScoreGameRound(): int
    {
        return $this->roundScore;
    }
}
