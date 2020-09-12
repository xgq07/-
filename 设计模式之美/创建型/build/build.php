<?php

//class ResourcePoolConfig
//{
//    private const DEFAULT_MAX_TOTAL = 8;
//    private const DEFAULT_MAX_IDLE = 8;
//    private const DEFAULT_MIN_IDLE = 0;
//
//
//    private $name;
//    private $maxTotal = self::DEFAULT_MAX_TOTAL;
//    private $maxIdle = self::DEFAULT_MAX_IDLE;
//    private $minIdle = self::DEFAULT_MIN_IDLE;
//
//    public function __construct(string $name, $maxTotal, $maxIdle, $minIdle)
//    {
//        if (empty($name)) {
//            throw new InvalidArgumentException('name should not empty!');
//        }
//
//        $this->name = $name;
//
//
//        if (is_int($maxTotal) === false || $maxTotal <= 0) {
//            throw new InvalidArgumentException('最大总资源必须为数值且数量必须大于等于0');
//        } else {
//            $this->maxTotal = $maxTotal;
//        }
//
//        if (is_int($maxIdle) === false || $maxIdle <= 0) {
//            throw new InvalidArgumentException('最大空闲资源必须必须大于0');
//        } else {
//            $this->maxTotal = $maxIdle;
//        }
//
//        if (is_int($minIdle) === false || $minIdle <= 0) {
//            throw new InvalidArgumentException('最小空闲资源必须必须大于0');
//        } else {
//            $this->maxTotal = $minIdle;
//        }
//    }
//
//    public function getConfig()
//    {
//        echo $this->name, $this->maxTotal, $this->maxIdle, $this->minIdle, PHP_EOL;
//    }
//}

//class ResourcePoolConfig
//{
//    private const DEFAULT_MAX_TOTAL = 8;
//    private const DEFAULT_MAX_IDLE = 8;
//    private const DEFAULT_MIN_IDLE = 0;
//
//
//    private $name;
//    private $maxTotal = self::DEFAULT_MAX_TOTAL;
//    private $maxIdle = self::DEFAULT_MAX_IDLE;
//    private $minIdle = self::DEFAULT_MIN_IDLE;
//
//    public function __construct(string $name)
//    {
//        if (empty($name)) {
//            throw new InvalidArgumentException('name should not empty!');
//        }
//
//        $this->name = $name;
//    }
//
//    public function setMaxTotal($maxTotal){
//        if (is_int($maxTotal) === false || $maxTotal <= 0) {
//            throw new InvalidArgumentException('最大总资源必须为数值且数量必须大于0');
//        } else {
//            $this->maxTotal = $maxTotal;
//        }
//    }
//
//    public function setMaxIdle($maxIdle){
//        if (is_int($maxIdle) === false || $maxIdle < 0) {
//            throw new InvalidArgumentException('最大空闲资源必须必须大于等于0');
//        } else {
//            $this->maxTotal = $maxIdle;
//        }
//    }
//
//    public function setMinIdle($minIdle){
//        if (is_int($minIdle) === false || $minIdle < 0) {
//            throw new InvalidArgumentException('最小空闲资源必须必须大于等于0');
//        } else {
//            $this->maxTotal = $minIdle;
//        }
//    }
//
//    public function getConfig()
//    {
//        echo $this->name, $this->maxTotal, $this->maxIdle, $this->minIdle, PHP_EOL;
//    }
//}


class ResourcePoolConfig
{
    private $name;
    private $maxTotal;
    private $maxIdle;
    private $minIdle;

    public function __construct(ResourcePoolConfigBuilder $poolConfigBuilder)
    {
        $this->name = $poolConfigBuilder->getName();
        $this->maxTotal = $poolConfigBuilder->getMaxTotal();
        $this->maxIdle = $poolConfigBuilder->getMaxIdle();
    }
}


class  ResourcePoolConfigBuilder
{

    private const DEFAULT_MAX_TOTAL = 8;
    private const DEFAULT_MAX_IDLE = 8;
    private const DEFAULT_MIN_IDLE = 0;


    private $name;
    private $maxTotal = self::DEFAULT_MAX_TOTAL;
    private $maxIdle = self::DEFAULT_MAX_IDLE;
    private $minIdle = self::DEFAULT_MIN_IDLE;

    public function __construct()
    {

    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('name should not empty!');
        }
        $this->name = $name;
    }

    public function getMaxTotal()
    {
        return $this->maxTotal;
    }

    public function setMaxTotal($maxTotal)
    {
        if (is_int($maxTotal) === false || $maxTotal <= 0) {
            throw new InvalidArgumentException('最大总资源必须为数值且数量必须大于0');
        } else {
            $this->maxTotal = $maxTotal;
        }
    }

    public function getMaxIdle()
    {
        return $this->maxTotal;
    }

    public function setMaxIdle($maxIdle)
    {
        if (is_int($maxIdle) === false || $maxIdle < 0) {
            throw new InvalidArgumentException('最大空闲资源必须必须大于等于0');
        } else {
            $this->maxIdle = $maxIdle;
        }
    }

    public function setMinIdle($minIdle)
    {
        if (is_int($minIdle) === false || $minIdle < 0) {
            throw new InvalidArgumentException('最小空闲资源必须必须大于等于0');
        } else {
            $this->minIdle = $minIdle;
        }
    }

    public function build()
    {
        // 校验逻辑放到这里来做，包括必填项校验、依赖关系校验、约束条件校验等
        if (empty($this->name)) {
            throw new InvalidArgumentException('name should not empty!');
        }

        if ($this->maxIdle > $this->maxTotal) {
            throw new InvalidArgumentException('maxIdle must < maxTotal');
        }
        return new ResourcePoolConfig($this);
    }
}

$r = new  ResourcePoolConfigBuilder();
$r->setName('qiu');
$r->setMaxIdle(10);
$resource = $r->build();
var_dump($resource);

