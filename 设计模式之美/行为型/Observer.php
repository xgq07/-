<?php

//interface Observer
//{
//    public function update(string $message);
//}
//
//interface Subject
//{
//    public function registerObserver(Observer $observer);
//
//    public function removeObserver(Observer $observer);
//
//    public function notifyObserver(string $message);
//}
//
//class ConcreteSubject implements Subject
//{
//    private $observers;
//
//    public function registerObserver(Observer $observer)
//    {
//        $this->observers[] = $observer;
//    }
//
//    public function removeObserver(Observer $observer)
//    {
//        $key = array_search($observer, $this->observers);
//        unset($this->observers[$key]);       //索引不会变
////        array_splice($this->observers, 0);
//    }
//
//    public function notifyObserver(string $message)
//    {
//        foreach ($this->observers as $observer)
//        {
//            $observer->update($message);
//        }
//    }
//}
//
//class ConcreteObserverOne implements Observer
//{
//    public function update(string $message)
//    {
//        //TODO: 获取消息通知，执行自己的逻辑...
//        print_r('ConcreteObserverOne :'. $message .PHP_EOL);
//    }
//}
//
//class ConcreteObserverTwo implements Observer
//{
//    public function update(string $message)
//    {
//        //TODO: 获取消息通知，执行自己的逻辑...
//        print_r('ConcreteObserverTwo :'. $message .PHP_EOL);
//    }
//}
//
//$concrete = new ConcreteSubject();
//$concrete->registerObserver(new ConcreteObserverOne());
//$concrete->registerObserver(new ConcreteObserverTwo());
//$concrete->notifyObserver("jjj");

class PromotionObServer
{
    public function issueNewUserExperienceCash()
    {
    }
}

class NotificationServer
{
    public function sendInboxMessage()
    {
    }
}

interface RegObserver
{
    public function handleRegSuccess(int $userId);
}

class RegPromotionObserver implements RegObserver
{
    private $promotionService; // 依赖注入

    public function __construct($promotionService)
    {
        $this->promotionService = $promotionService;
    }

    public function handleRegSuccess(int $userId)
    {
        $this->promotionService->issueNewUserExperienceCash($userId);
    }
}

class RegNotificationObserver implements RegObserver
{
    private $notifcationService; // 依赖注入

    public function __construct($promotionService)
    {
        $this->notifcationService = $promotionService;
    }

    public function handleRegSuccess(int $userId)
    {
        $this->notifcationService->sendInboxMessage($userId);
    }
}


class UserController
{
    private $userService; // 依赖注入

    private $regObservers;

    public function setRegObservers(RegObserver $regObserver)
    {
        // 一次性设置好，之后也不可能动态的修改
        $this->regObservers = $regObserver;
    }

    public function register(string $telephone, string $password): int
    {
        //省略输入参数的校验代码
        //省略userService.register()异常的try-catch代码
        $userId = $this->userService->register($telephone, $password);

        foreach ($this->regObservers as $regObserver) {
            $regObserver->handleRegSuccess($userId);
        }

        return $userId;
    }
}