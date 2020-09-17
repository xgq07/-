<?php

//abstract class Handler
//{
//    protected $successor = null;
//
//    public function setSuccessor($successor)
//    {
//        $this->successor = $successor;
//    }
//
//    public abstract function handle();
//}
//
//class HandlerA extends Handler
//{
//    public function handle()
//    {
//        $handled = false;
//        print_r('handleA run '.PHP_EOL);
//        //...
//        if (!$handled && !empty($this->successor)) {
//            $this->successor->handle();
//        }
//    }
//}
//
//
//class HandlerB extends Handler
//{
//    public function handle()
//    {
//        $handled = false;
//        print_r('handleB run '.PHP_EOL);
//        //...
//        if (!$handled && !empty($this->successor))
//        {
//            $this->successor->handle();
//        }
//    }
//}
//
//class HandlerChain
//{
//    private $head;
//    private $tail;
//
//    public function addHandler(Handler $handler)
//    {
//        $handler->setSuccessor(null);
//        if (empty($this->head)) {
//            $this->head = $handler;
//            $this->tail = $handler;
//        }
//        $this->tail->setSuccessor($handler);
//        $this->tail = $handler;
//    }
//
//    public function handle()
//    {
//        if (!empty($this->head)) {
//            $this->head->handle();
//        }
//    }
//
//}
//
//$chain = new HandlerChain();
//$chain->addHandler(new HandlerA());
//$chain->addHandler(new HandlerB());
//$chain->handle();


abstract class Handler
{
    protected $successor = null;

    public function setSuccessor($successor)
    {
        $this->successor = $successor;
    }

    public final function handle()
    {
        $handle = $this->doHandle();
        if (!empty($this->successor) && !$handle)
        {
            $this->successor->handle();
        }
    }

    protected abstract function doHandle();
}

class HandlerA extends Handler
{
    public function doHandle()
    {
        $handled = false;
        print_r('handleA run '.PHP_EOL);
        //...
        return $handled;
    }
}

class HandlerB extends Handler
{
    public function doHandle()
    {
        $handled = false;
        print_r('handleB run '.PHP_EOL);
        //...
        return $handled;
    }
}

class HandlerChain
{
    private $head;
    private $tail;

    public function addHandler(Handler $handler)
    {
        $handler->setSuccessor(null);
        if (empty($this->head)) {
            $this->head = $handler;
            $this->tail = $handler;
        }
        $this->tail->setSuccessor($handler);
        $this->tail = $handler;
    }

    public function handle()
    {
        if (!empty($this->head)) {
            $this->head->handle();
        }
    }

}

$chain = new HandlerChain();
$chain->addHandler(new HandlerA());
$chain->addHandler(new HandlerB());
$chain->handle();


