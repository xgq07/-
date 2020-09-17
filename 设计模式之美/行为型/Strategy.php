<?php

interface Strategy
{
    public function algorithmInterface();
}

class ConcreteStrategyA implements Strategy
{
    public function __construct()
    {
        print_r('ConcreteStrategyA'.PHP_EOL);
    }

    public function algorithmInterface()
    {
        //具体的算法...
    }
}

class ConcreteStrategyB implements Strategy
{
    public function __construct()
    {
        print_r('ConcreteStrategyB'.PHP_EOL);
    }

    public function algorithmInterface()
    {
        //具体的算法...
    }
}

class StrategyFactory
{
    private static $strategies = [];

    private static function initStrategies()
    {
        self::$strategies = [
            'A' => new ConcreteStrategyA(),
            'B' => new ConcreteStrategyB(),
        ];
    }

    public function A()
    {
        return new ConcreteStrategyA();
    }

    public static function getStrategy(string $type)
    {
//        if (empty(self::$strategies))
            self::initStrategies();

        return self::$strategies[$type];
    }
}



/*每次获得新对象*/
class StrategyFactory2
{
    public static function getStrategy(string $type)
    {
        if ("A" == $type)
            return new ConcreteStrategyA();
        elseif ("B" == $type)
            return new ConcreteStrategyB();

        return null;
    }
}


StrategyFactory::getStrategy('A');
StrategyFactory::getStrategy('A');


