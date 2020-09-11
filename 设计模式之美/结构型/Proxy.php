<?php


class RequestInto
{
    public function __construct(string $funName, int $responseTime, int $startTime)
    {
    }
}

class MericsConllector
{
    public function recordRequest(RequestInto $requestInto)
    {

    }
}

class UserController
{
    private $mericsCollector;

    public function __construct(MericsConllector $mericsCollector)
    {
        $this->mericsCollector = $mericsCollector;
    }

    public function login()
    {
        $starTimeStamp = (int)(microtime(true) * 1000);
        // ... 省略login逻辑...
        sleep(1);
        $endTimeStamp = (int)(microtime(true) * 1000);
        $responseTime = $endTimeStamp - $starTimeStamp;

        $requestInfo = new RequestInto('login', $responseTime, $starTimeStamp);
        $this->mericsCollector->recordRequest($requestInfo);
        //...返回UserVo数据...
        var_dump($responseTime);
        var_dump($starTimeStamp);
        var_dump($endTimeStamp);
    }

    public function register()
    {
        $starTimeStamp = (int)(microtime(true) * 1000);
        // ... 省略register逻辑...
        $endTimeStamp = (int)(microtime(true) * 1000);
        $responseTime = $endTimeStamp - $starTimeStamp;

        $requestInfo = new RequestInto('register', $responseTime, $starTimeStamp);
        $this->mericsCollector->recordRequest($requestInfo);
        //...返回UserVo数据...
    }
}

$merics = new MericsConllector();
$u = new UserController($merics);
$u->login();
