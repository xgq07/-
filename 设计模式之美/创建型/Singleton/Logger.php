<?php
namespace TestLogger;

class Logger{

    //存放实例 私有静态变量
    private static $_instance ;

    private function __construct()
    {
        $this->file = fopen('.\\qiu_log.txt', 'a');

    }

    // 阻止用户复制对象实例
    public function __clone(){
        trigger_error('Clone is not allowed.',E_USER_ERROR);
    }

    public function log(string $message)
    {
        $f = fopen('lockfile', 'w');
        if (flock($f, LOCK_EX)) {
            fwrite($this->file, $message . PHP_EOL);
            flock($f, LOCK_UN);
        }
//        fclose($this->file);
    }

    public static function getInstance(){
        if (!(self::$_instance instanceof Logger)){
            self::$_instance = new Logger();
        }
        return self::$_instance;
    }
}
