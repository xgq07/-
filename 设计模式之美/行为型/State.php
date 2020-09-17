<?php

class State
{
    const SMALL = 0;
    const SUPER = 0;
    const FIRE = 0;
    const CAPE = 0;


    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}

class MarioStateMachine
{
    private $score;
    private $currentState;

    public function __construct()
    {
        $this->score = 0;
        $this->currentState = State::SMALL;
    }

    public function obtainMushRoom()
    {
        if(State::SMALL ==  $this->currentState)
        {
            $this->currentState = State::SUPER;
            $this->score += 100;
        }
    }

    public function obtainCape()
    {
        if(State::SMALL ==  $this->currentState || State::SUPER == $this->currentState)
        {
            $this->currentState = State::CAPE;
            $this->score += 200;
        }
    }

    public function obtainFireFlower()
    {
        if(State::SMALL ==  $this->currentState || State::SUPER == $this->currentState)
        {
            $this->currentState = State::FIRE;
            $this->score += 300;
        }
    }


    public function meetMonster()
    {
        if( State::SUPER == $this->currentState)
        {
            $this->currentState = State::SMALL;
            $this->score -= 100;
            return;
        }

        if( State::CAPE == $this->currentState)
        {
            $this->currentState = State::SMALL;
            $this->score -= 200;
            return;
        }

        if( State::FIRE == $this->currentState)
        {
            $this->currentState = State::SMALL;
            $this->score -= 300;
            return;
        }
    }

    public function getScore()
    {
        return  $this->score;
    }

    public function getCurrentState()
    {
        return $this->currentState;
    }

}

