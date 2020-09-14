<?php
//
//// 类适配器: 基于继承
//interface ITarget
//{
//    public function f1();
//
//    public function f2();
//
//    public function fc();
//}
//
//class  Adaptee
//{
//    public function fa()
//    {
//    }
//
//    public function fb()
//    {
//    }
//
//    public function fc()
//    {
//    }
//}
//
//
//class Adaptor extends Adaptee implements ITarget
//{
//    public function f1()
//    {
//        parent::fa();
//    }
//
//    public function f2()
//    {
//        //...重新实现f2()...
//    }
//
//
//    //这里fc()不需要实现，直接继承自Adaptee，这是跟对象适配器最大的不同点
//}
//
//
//// 对象适配器：基于组合
//interface ITarget2
//{
//    public function f1();
//
//    public function f2();
//
//    public function fc();
//}
//
//
//class  Adaptee2
//{
//    public function fa()
//    {
//    }
//
//    public function fb()
//    {
//    }
//
//    public function fc()
//    {
//    }
//}
//
//class Adaptor2 implements ITarget
//{
//    private $Adptee2;
//
//    public function __construct(Adaptee2 $adaptee2)
//    {
//        $this->Adptee2 = $adaptee2;
//    }
//
//    public function f1()
//    {
//        $this->Adptee2->fa();
//    }
//
//    public function f2()
//    {
//        //...重新实现f2()...
//    }
//
//    public function fc(){
//        $this->Adptee2->fc();
//    }
//}


class ASensitiveWordsFilter
{ // A敏感词过滤系统提供的接口
    //text是原始文本，函数输出用***替换敏感词之后的文本
    public function filterSexyWords(string $text)
    {
        print_r('filterSexyWords'.PHP_EOL);
        return $text;
    }

    public function filterPoliticalWords(string $text)
    {
        print_r('filterPoliticalWords'.PHP_EOL);
        return $text;
    }
}

class BSensitiveWordsFilter
{// B敏感词过滤系统提供的接口
    public function filter(string $text)
    {
        print_r('Bfilter'.PHP_EOL);
        return $text;
    }
}

class CSensitiveWordsFilter
{// C敏感词过滤系统提供的接口
    public function filter(string $text, string $mask)
    {
        return $text;
    }
}

// 未使用适配器模式之前的代码：代码的可测试性、扩展性不好
class RiskManagement
{
    private $aFilter;
    private $bFilter;
    private $cFilter;

    public function __construct()
    {
        $this->aFilter = new ASensitiveWordsFilter();
        $this->bFilter = new BSensitiveWordsFilter();
        $this->cFilter = new CSensitiveWordsFilter();
    }

    public function filterSensitiveWords(string $text)
    {
        $maskedText = $this->aFilter->filterSexyWords($text);
        $maskedText = $this->aFilter->filterPoliticalWords($maskedText);
        $maskedText = $this->bFilter->filter($maskedText);
        $maskedText = $this->cFilter->filter($maskedText, "***");
        return $maskedText;
    }
}

// 使用适配器模式进行改造
interface ISensitiveWordsFilter {// 统一接口定义
    public function filter(string $text);
}

class ASensitiveWordsFilterAdaptor  implements ISensitiveWordsFilter
{
    private $aSensitiveWordsFilter;

    public function __construct()
    {
        $this->aSensitiveWordsFilter = new ASensitiveWordsFilter();
    }

    public function filter(string $text)
    {
        $maskedText = $this->aSensitiveWordsFilter->filterSexyWords($text);
        $maskedText = $this->aSensitiveWordsFilter->filterPoliticalWords($maskedText);
        return $maskedText;
    }
}
class BSensitiveWordsFilterAdaptor implements ISensitiveWordsFilter
{
    private $bSensitiveWordsFilter;

    public function __construct()
    {
        $this->bSensitiveWordsFilter = new BSensitiveWordsFilter();
    }

    public function filter(string $text)
    {
        $maskedText =$this->bSensitiveWordsFilter->filter($text);
        return $maskedText;
    }
}


//...省略CSensitiveWordsFilterAdaptor...

// 扩展性更好，更加符合开闭原则，如果添加一个新的敏感词过滤系统，
// 这个类完全不需要改动；而且基于接口而非实现编程，代码的可测试性更好。
class RiskManagement2 {

    private $filters;
    public function addSensitiveWordsFilter (ISensitiveWordsFilter $filter)
    {
        $this->filters[] = $filter;
    }

    public function filterSensitiveWords($text){
        $maskedText = $text;
        foreach ($this->filters as $filter)
        {
            $filter->filter($text);
        }

        return $maskedText;
    }
}


$afilter = new ASensitiveWordsFilterAdaptor();
$bfilter = new BSensitiveWordsFilterAdaptor();
$risk = new RiskManagement2();
$risk->addSensitiveWordsFilter($afilter);
$risk->addSensitiveWordsFilter($bfilter);
$risk->filterSensitiveWords('aaa');



