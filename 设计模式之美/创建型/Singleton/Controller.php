<?php
namespace TestLogger;
include_once 'Logger.php';
class UserController{
    private $Logger;
    public function __construct()
    {
        $this->Logger = Logger::getInstance();
    }

    public function login(string $username , string $pwd){
//        $this->Logger->log($username.' login');
        $this->Logger->log($username.' login');
    }

    public function getLogger()
    {
        return $this->Logger;
    }
}


class OrderController{
    private $Logger;
    public function __construct()
    {
        $this->Logger = Logger::getInstance();
    }

    public function create(string $orderNum){
//        $this->Logger->log('create an order:' . $orderNum);
        $this->Logger->log('create an order:' . $orderNum);
    }

    public function getLogger()
    {
        return $this->Logger;
    }
}

print_r('start'.PHP_EOL);

$u = new UserController();
$u->login("qiu", "ddd");

$o = new OrderController();
$o->create('888168');
print_r('end');

$t = $u->getLogger() === $o->getLogger();
var_dump($t);

