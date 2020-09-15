<?php
//
//
//class RequestInto
//{
//    public function __construct(string $funName, int $responseTime, int $startTime)
//    {
//    }
//}
//
//class MericsConllector
//{
//    public function recordRequest(RequestInto $requestInto)
//    {
//
//    }
//}
//
//class UserController
//{
//    public function __construct()
//    {
//        $this->mericsCollector = new MericsConllector();
//    }
//
//    public function login()
//    {
//        $starTimeStamp = (int)(microtime(true) * 1000);
//        // ... 省略login逻辑...
//        sleep(1);
//        $endTimeStamp = (int)(microtime(true) * 1000);
//        $responseTime = $endTimeStamp - $starTimeStamp;
//
//        $requestInfo = new RequestInto('login', $responseTime, $starTimeStamp);
//        $this->mericsCollector->recordRequest($requestInfo);
//        //...返回UserVo数据...
//        var_dump($responseTime);
//        var_dump($starTimeStamp);
//        var_dump($endTimeStamp);
//    }
//
//    public function register()
//    {
//        $starTimeStamp = (int)(microtime(true) * 1000);
//        // ... 省略register逻辑...
//        $endTimeStamp = (int)(microtime(true) * 1000);
//        $responseTime = $endTimeStamp - $starTimeStamp;
//
//        $requestInfo = new RequestInto('register', $responseTime, $starTimeStamp);
//        $this->mericsCollector->recordRequest($requestInfo);
//        //...返回UserVo数据...
//    }
//}
//
//$u = new UserController();
//$u->login();


//interface IUserController
//{
//    public function login();
//
//    public function register();
//}
//
//class RequestInto
//{
//    public function __construct(string $funName, int $responseTime, int $startTime)
//    {
//    }
//}
//
//class MericsConllector
//{
//    public function recordRequest(RequestInto $requestInto)
//    {
//
//    }
//}
//
//class UserController implements IUserController
//{
//    public function login()
//    {
//        // ... 省略login逻辑...
//        sleep(1);
//        //...返回UserVo数据...
//    }
//
//    public function register()
//    {
//        // ... 省略register逻辑...
//        sleep(1);
//        //...返回UserVo数据...
//    }
//}
//
//class UserControllerProxy implements IUserController
//{
//    private $mericsCollector;
//    private $userController;
//
//    public function __construct(UserController $userController)
//    {
//        $this->mericsCollector = new MericsConllector();
//        $this->userController = $userController;
//    }
//
//    function login()
//    {
//        $starTimeStamp = (int)(microtime(true) * 1000);
//        $this->userController->login();
//        $endTimeStamp = (int)(microtime(true) * 1000);
//        $responseTime = $endTimeStamp - $starTimeStamp;
//
//        $requestInfo = new RequestInto('login', $responseTime, $starTimeStamp);
//        $this->mericsCollector->recordRequest($requestInfo);
//        //...返回UserVo数据...
//        var_dump($responseTime);
//        var_dump($starTimeStamp);
//        var_dump($endTimeStamp);
//    }
//
//    public
//    function register()
//    {
//        $starTimeStamp = (int)(microtime(true) * 1000);
//        $this->userController->register();
//        $endTimeStamp = (int)(microtime(true) * 1000);
//        $responseTime = $endTimeStamp - $starTimeStamp;
//
//        $requestInfo = new RequestInto('register', $responseTime, $starTimeStamp);
//        $this->mericsCollector->recordRequest($requestInfo);
//        //...返回UserVo数据...
//    }
//}
//
//$u = new UserControllerProxy(new UserController());
//$u->login();



class UserController
{
    public function login()
    {
        // ... 省略login逻辑...
        sleep(1);
        //...返回UserVo数据...
    }

    public function register()
    {
        // ... 省略register逻辑...
        sleep(1);
        //...返回UserVo数据...
    }
}

class MetricsCollectorProxy
{
    private $target;

    public function createProxy($obj){
        $this->target[] = $obj;
    }

    function __call($name, $args){
        foreach($this->target as $obj){
            $r = new ReflectionClass($obj);
            if($method = $r->getMethod($name)){
                if($method->isPublic() && !$method->isAbstract()){
                    echo "method before record \r\n";
                    $method->invoke($obj,$args);
                    echo "method after record\r\n";
                }
            }
        }
    }
}

$u1 = new UserController();
$u2 = new UserController();

$proxy = new MetricsCollectorProxy();
$proxy->addObj($u1);
$proxy->addObj($u2);
$proxy->login();
