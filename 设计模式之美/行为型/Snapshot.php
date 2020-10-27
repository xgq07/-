<?php

class InputText
{
    private $text;
    private $appendText;

    function getText()
    {
        return $this->text;
    }

    function append(string $input)
    {
        $this->appendText = $input;
        $this->text .= $this->appendText;
    }

    function setText()
    {
       $this->text =  rtrim($this->text, $this->appendText);
    }
}


class SnapshotHolder
{
    private $snapshots ;

    public function __construct()
    {
        $this->snapshots = new SplStack();
    }

    public function popSnapshot()
    {
        return $this->snapshots->pop();
    }

    public function pushSnapshot()
    {
        $deepClonedInputText = new InputText();
        $deepClonedInputText->setText();
        $this->snapshots->push($deepClonedInputText);
    }
}

$inputText = new InputText();
$snapshotsHolder = new SnapshotHolder();    //这里没体现出SnapshotHolder类的作用。其实是用来存储上一次操作的字符串的。
while (true)
{
    $input = trim(fgets(STDIN));
    if ($input == ':list')
    {
        print_r('into :list'. PHP_EOL);
        print_r($inputText->getText() . PHP_EOL);
    }
    elseif ($input == ':undo')
    {
        $snapshotsHolder->popSnapshot();
        $inputText->setText();
    }
    else{
        $snapshotsHolder->pushSnapshot();
        $inputText->append($input);
    }
    print_r('input ' . $input . ',loop again'.PHP_EOL);
}



