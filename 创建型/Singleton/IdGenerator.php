<?php
namespace IdGenerator;

class IdGenerator{

    //存放实例 私有静态变量
    private static $_instance ;
    private static $_id;
    private function __construct()
    {

    }

    // 阻止用户复制对象实例
    public function __clone(){
        trigger_error('Clone is not allowed.',E_USER_ERROR);
    }

    public function getId()
    {
        $f = fopen('lockfile', 'w');

        if (flock($f, LOCK_EX)) {
            self::$_id += 1;
            $tmp_id = self::$_id;
            flock($f, LOCK_UN);
            fclose($f);
        }

        return $tmp_id;
    }


    public static function getInstance(){
        if (!(self::$_instance instanceof IdGenerator)){
            self::$_instance = new IdGenerator();
        }
        return self::$_instance;
    }
}


$id1 = IdGenerator::getInstance();
$id2 = IdGenerator::getInstance();
$id3 = IdGenerator::getInstance();
$id4 = IdGenerator::getInstance();

print_r($id1->getId() . PHP_EOL);
print_r($id2->getId() . PHP_EOL);
print_r($id3->getId() . PHP_EOL);
print_r($id4->getId() . PHP_EOL);
