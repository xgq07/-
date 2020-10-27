<?php

//interface MyIterator
//{
//    public function hasNext();
//
//    public function next();
//
//    public function currentItem();
//}
//
//class MyArrayIterator implements MyIterator
//{
//    private $cursor;
//    private $arrayList;
//
//    public function __construct(array $arrayList)
//    {
//        $this->cursor = 0;
//        $this->arrayList = $arrayList;
//    }
//
//    public function hasNext(): bool
//    {
//        return $this->cursor != count($this->arrayList);//注意这里，cursor在指向最后一个元素的时候，hasNext()仍旧返回true。
//    }
//
//    public function next(): int
//    {
//        return $this->cursor++;
//    }
//
//    public function currentItem()
//    {
//        if ($this->cursor >= count($this->arrayList)) {
//            throw new OutOfRangeException();
//        }
//        return $this->arrayList[$this->cursor];
//    }
//}
//
//$names = [];
//$names[]  = "xzg";
//$names[]  = "wang";
//$names[]  = "zheng";
//$iterator = new MyArrayIterator($names);
//while ($iterator->hasNext()) {
//    print_r($iterator->currentItem(). PHP_EOL);
//    $iterator->next();
//}

interface MyIterator
{
    public function hasNext();

    public function next();

    public function currentItem();
}

interface MyList
{
    function  iterator();
}

class MyArrayIterator implements MyIterator
{
    private $cursor;
    private $arrayList;

    public function __construct(array $arrayList)
    {
        $this->cursor = 0;
        $this->arrayList = $arrayList;
    }

    public function hasNext(): bool
    {
        return $this->cursor != count($this->arrayList);//注意这里，cursor在指向最后一个元素的时候，hasNext()仍旧返回true。
    }

    public function next(): int
    {
        return $this->cursor++;
    }

    public function currentItem()
    {
        if ($this->cursor >= count($this->arrayList)) {
            throw new OutOfRangeException();
        }
        return $this->arrayList[$this->cursor];
    }
}


class MyArrayList implements MyList
{

    private $arrayList;

    public function __construct(array $arrayList)
    {
        $this->arrayList = $arrayList;
    }

    public function iterator()
    {
        return new MyArrayIterator($this->arrayList);
    }
}

$names = new MyArrayList([]);
$names[]  = "xzg";
$names[]  = "wang";
$names[]  = "zheng";
