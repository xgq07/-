<?php

//class UserServiceTest{
//    public static function doTest(){
//        // ...
//    }
//
//    public static function main(array $args){
//        if (UserServiceTest::doTest()) {
//            print_r("Test success");
//        }else{
//            print_r("Test failed.");
//        }
//
//    }
//}

abstract class TestCase{
    public function run(){
        if (UserServiceTest::doTest()) {
            print_r("Test success");
        }else{
            print_r("Test failed.");
        }
    }

    public abstract function doTest();
}

class JunitApplication
{
    private static $testCases = array();

    public static function register(TestCase $testCase)
    {
        self::$testCases[] = $testCase;
    }

    public static function main(array $args)
    {
        foreach (self::$testCases as $case)
        {
            $case->run();
        }
    }
}

class UserServiceTest extends TestCase {
    public function doTest()
    {
        return true;
    }
}


JunitApplication::register(new UserServiceTest());
JunitApplication::main([]);
