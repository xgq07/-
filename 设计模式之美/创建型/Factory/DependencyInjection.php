<?php

class Profile
{
    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
        print_r('init Profile');
    }
}

class Setting
{
    public function __construct(Marker $marker)
    {
        print_r('init Setting'. PHP_EOL);
    }
}

class Marker
{
}


class Container implements ArrayAccess
{
    /**
     * 单例
     * @var Container
     */
    protected static $instance;

    /**
     * 容器所管理的实例
     * @var array
     */
    protected $instances = [];

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * 获取单例的实例
     * @param string $class
     * @param array ...$params
     * @return object
     */
    public function singleton($class, ...$params)
    {
        if (isset($this->instances[$class])) {
            return $this->instances[$class];
        } else {
            $this->instances[$class] = $this->make($class, $params);
        }

        return $this->instances[$class];
    }

    /**
     * 获取实例（每次都会创建一个新的）
     * @param string $class
     * @param array ...$params
     * @return object
     */
    public function get($class, ...$params)
    {
        return $this->make($class, $params);
    }

    /**
     * 工厂方法，创建实例，并完成依赖注入
     * @param string $class
     * @param array $params
     * @return object
     */
    protected function make($class, $params = [])
    {
        //如果不是反射类根据类名创建
        $class = is_string($class) ? new ReflectionClass($class) : $class;

        //如果传的入参不为空，则根据入参创建实例
        if (!empty($params)) {
            return $class->newInstanceArgs($params);
        }

        //获取构造方法
        $constructor = $class->getConstructor();

        //获取构造方法参数
        $parameterClasses = $constructor ? $constructor->getParameters() : [];

        if (empty($parameterClasses)) {
            //如果构造方法没有入参，直接创建
            return $class->newInstance();
        } else {
            //如果构造方法有入参，迭代并递归创建依赖类实例
            foreach ($parameterClasses as $parameterClass) {
                $paramClass = $parameterClass->getClass();
                $params[]   = $this->make($paramClass);
            }
            //最后根据创建的参数创建实例，完成依赖的注入
            return $class->newInstanceArgs($params);
        }
    }

    /**
     * @return Container
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function __get($class)
    {
        if (!isset($this->instances[$class])) {
            $this->instances[$class] = $this->make($class);
        }
        return $this->instances[$class];
    }

    public function offsetExists($offset)
    {
        return isset($this->instances[$offset]);
    }

    public function offsetGet($offset)
    {
        if (!isset($this->instances[$offset])) {
            $this->instances[$offset] = $this->make($offset);
        }
        return $this->instances[$offset];
    }

    public function offsetSet($offset, $value)
    {
    }

    public function offsetUnset($offset)
    {
        unset($this->instances[$offset]);
    }
}

$container = Container::getInstance();

$profile   = $container->singleton(Profile::class);
$profile2  = $container->singleton(Profile::class);
//只打印
//init Setting
//init Profile
