<?php

//class State
//{
//    const SMALL = 0;
//    const SUPER = 0;
//    const FIRE = 0;
//    const CAPE = 0;
//
//
//    private $value;
//
//    public function __construct(int $value)
//    {
//        $this->value = $value;
//    }
//
//    public function getValue()
//    {
//        return $this->value;
//    }
//}
//
//class MarioStateMachine
//{
//    private $score;
//    private $currentState;
//
//    public function __construct()
//    {
//        $this->score = 0;
//        $this->currentState = State::SMALL;
//    }
//
//    public function obtainMushRoom()
//    {
//        if(State::SMALL ==  $this->currentState)
//        {
//            $this->currentState = State::SUPER;
//            $this->score += 100;
//        }
//    }
//
//    public function obtainCape()
//    {
//        if(State::SMALL ==  $this->currentState || State::SUPER == $this->currentState)
//        {
//            $this->currentState = State::CAPE;
//            $this->score += 200;
//        }
//    }
//
//    public function obtainFireFlower()
//    {
//        if(State::SMALL ==  $this->currentState || State::SUPER == $this->currentState)
//        {
//            $this->currentState = State::FIRE;
//            $this->score += 300;
//        }
//    }
//
//
//    public function meetMonster()
//    {
//        if( State::SUPER == $this->currentState)
//        {
//            $this->currentState = State::SMALL;
//            $this->score -= 100;
//            return;
//        }
//
//        if( State::CAPE == $this->currentState)
//        {
//            $this->currentState = State::SMALL;
//            $this->score -= 200;
//            return;
//        }
//
//        if( State::FIRE == $this->currentState)
//        {
//            $this->currentState = State::SMALL;
//            $this->score -= 300;
//            return;
//        }
//    }
//
//    public function getScore()
//    {
//        return  $this->score;
//    }
//
//    public function getCurrentState()
//    {
//        return $this->currentState;
//    }
//
//}


class State
{
    const SMALL = 0;
    const SUPER = 1;
    const FIRE = 2;
    const CAPE = 3;


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

class Event
{
    const GOT_MUSHROOM = 0;
    const GOT_CAPE = 1;
    const GOT_FIRE = 2;
    const MET_MONSTER = 3;


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

    private static $transitionTalbe = [
        [State::SUPER, State::CAPE, State::FIRE, State::SMALL],
        [State::SUPER, State::CAPE, State::FIRE, State::SMALL],
        [State::CAPE, State::CAPE, State::CAPE, State::SMALL],
        [State::FIRE, State::FIRE, State::FIRE, State::SMALL]
    ];

    private static $actionTable = [
        [+100, +200, +300, +0],
        [+0, +200, +300, -100],
        [+0, +0, +0, -200],
        [+0, +0, +0, -300],
    ];

    public function __construct()
    {
        $this->score = 0;
        $this->currentState = new State(State::SMALL);
    }

    public function obtainMushRoom()
    {
        $this->executeEvent(new Event(Event::GOT_MUSHROOM));
    }

    public function obtainCape()
    {
        $this->executeEvent(new Event(Event::GOT_CAPE));
    }

    public function obtainFireFlower()
    {
        $this->executeEvent(new Event(Event::GOT_FIRE));
    }

    public function meetMonster()
    {
        $this->executeEvent(new Event(Event::MET_MONSTER));
    }



    private function executeEvent(Event $event)
    {
       $stateValue = $this->currentState->getValue();
       $eventValue = $event->getValue();
       $this->currentState = new State(self::$transitionTalbe[$stateValue][$eventValue]);
       $this->score += self::$actionTable[$stateValue][$eventValue];

    }


    public function getScore()
    {
        print_r($this->score .PHP_EOL);
        return $this->score;
    }

    public function getCurrentState()
    {
        print_r($this->currentState->getValue() .PHP_EOL);
        return $this->currentState;
    }

}

$m = new MarioStateMachine();
$m->getCurrentState();
$m->getScore();
$m->obtainCape();
$m->getCurrentState();
$m->getScore();

class State
{
    const SMALL = 0;
    const SUPER = 1;
    const FIRE = 2;
    const CAPE = 3;


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

interface IMario //所有状态类的接口
{
    public function getName();

    //以下是定义的事件
    public function obtainMushRoom();

    public function obtainCape();

    public function obtainFireFlower();

    public function meetMonster();
}

class SmallMario implements IMario
{
    private $stateMachine;

    public function __construct(MarioStateMachine $stateMachine)
    {
        $this->stateMachine = $stateMachine;
    }

    public function getName()
    {
        return State::SMALL;
    }

    public function obtainMushRoom()
    {
        $this->stateMachine->setCurrentState(new SuperMario($this->stateMachine));
        $this->stateMachine->setScore($this->stateMachine->getScore() + 100);
    }

    public function obtainCape()
    {
        $this->stateMachine->setCurrentState(new CapeMario($this->stateMachine));
        $this->stateMachine->setScore($this->stateMachine->getScore() + 200);
    }

    public function obtainFireFlower()
    {
        $this->stateMachine->setCurrentState(new FireMario($this->stateMachine));
        $this->stateMachine->setScore($this->stateMachine->getScore() + 300);
    }

    public function meetMonster()
    {
        // do nothing...
    }

}

class SuperMario implements IMario
{
    private $stateMachine;

    public function __construct(MarioStateMachine $stateMachine)
    {
        $this->stateMachine = $stateMachine;
    }

    public function getName()
    {
        return State::SUPER;
    }

    public function obtainMushRoom()
    {
        // do nothing...
    }

    public function obtainCape()
    {
        $this->stateMachine->setCurrentState(new CapeMario($this->stateMachine));
        $this->stateMachine->setScore($this->stateMachine->getScore() + 200);
    }

    public function obtainFireFlower()
    {
        $this->stateMachine->setCurrentState(new FireMario($this->stateMachine));
        $this->stateMachine->setScore($this->stateMachine->getScore() + 300);
    }

    public function meetMonster()
    {
        $this->stateMachine->setCurrentState(new FireMario($this->stateMachine));
        $this->stateMachine->setScore($this->stateMachine->getScore() - 100);
    }
}

class CapeMario implements IMario
{
    private $stateMachine;

    public function __construct(MarioStateMachine $stateMachine)
    {
        $this->stateMachine = $stateMachine;
    }
    public function getName()
    {
        return State::CAPE;
    }

    public function obtainMushRoom()
    {
        // do nothing...
    }

    public function obtainCape()
    {

    }

    public function obtainFireFlower()
    {

    }

    public function meetMonster()
    {

    }
}

class FireMario implements IMario
{
    private $stateMachine;

    public function __construct(MarioStateMachine $stateMachine)
    {
        $this->stateMachine = $stateMachine;
    }

    public function getName()
    {
        return State::FIRE;
    }

    public function obtainMushRoom()
    {
        // do nothing...
    }

    public function obtainCape()
    {

    }

    public function obtainFireFlower()
    {

    }

    public function meetMonster()
    {

    }
}

class MarioStateMachine
{
    private $score;
    private $currentState; // 不再使用枚举来表示状态

    public function __construct()
    {
        $this->score        = 0;
        $this->currentState = new SmallMario($this);
    }


    public function obtainMushRoom()
    {
        $this->currentState->obtainMushRoom();
    }

    public function obtainCape()
    {
        $this->currentState->obtainCape();
    }

    public function obtainFireFlower()
    {
        $this->currentState->obtainFireFlower();
    }

    public function meetMonster()
    {
        $this->currentState->meetMonster();
    }


    public function getScore()
    {
        print_r($this->score . PHP_EOL);
        return $this->score;
    }

    public function getCurrentState()
    {
        print_r($this->currentState->getName() . PHP_EOL);
        return $this->currentState;
    }

    public function setScore(int $score)
    {
        $this->score = $score;
    }

    public function setCurrentState(IMario $currentState)
    {
        $this->currentState = $currentState;
    }

}

$stateMachine = new MarioStateMachine();
$stateMachine->getScore();
$stateMachine->getCurrentState();
$stateMachine->obtainMushRoom();
$stateMachine->getScore();
$stateMachine->getCurrentState();