<?php

abstract class AbstractClass
{
    public final function templateMethod()
    {
        //...
        $this->method1();
        //...
        $this->method2();
    }

    protected abstract function method1();
    protected abstract function method2();
}

class ConcreteClass1 extends AbstractClass
{
    protected function method1(){
        //...
    }
    protected function method2(){
        //...
    }
}

class ConcreteClass2 extends AbstractClass
{
    protected function method1(){
        //...
    }
    protected function method2(){
        //...
    }
}

$demo = new ConcreteClass1();
$demo->templateMethod();


