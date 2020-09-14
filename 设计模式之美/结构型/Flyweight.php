<?php
//
//namespace Flyweight;
//include_once "Enum.php";
//
//class ChessPieceColor extends Enum
//{
//    const RED = 1;
//    const BLACK = 2;
//}
//
////棋子
//class ChessPiece
//{
//    private $id;
//    private $text;
//    private $color;
//    private $positionX;
//    private $positionY;
//
//    public function __construct(int $id, string $text, ChessPieceColor $color, int $positionX, int $positionY)
//    {
//        $this->id        = $id;
//        $this->text      = $text;
//        $this->color     = $color;
//        $this->positionX = $positionX;
//        $this->positionY = $positionY;
//    }
//    // ...省略其他属性和getter/setter方法...
//}
//
////棋局
//class ChessBoard
//{
//    private $chessPieces;
//
//    public function __construct()
//    {
//       $this->init();
//    }
//
//    private function init()
//    {
//        $this->chessPieces[] = new ChessPiece(1,'車', ChessPieceColor::BLACK(), 0, 0);
//        $this->chessPieces[] = new ChessPiece(2,'馬', ChessPieceColor::BLACK(), 0, 1);
//        //...省略摆放其他棋子的代码...
//    }
//
//    public function move(int $chessPiceceId, int $toPositionx, int $toPositionY)
//    {
//
//    }
//}
//
//
//$c = new ChessBoard();

namespace Flyweight;
include_once "Enum.php";

class ChessPieceColor extends Enum
{
    const RED = 1;
    const BLACK = 2;
}

// 享元类
class ChessPieceUnit
{
    private $id;
    private $text;
    private $color;

    public function __construct(int $id, string $text, ChessPieceColor $color)
    {
        $this->id    = $id;
        $this->text  = $text;
        $this->color = $color;
    }

    // ...省略其他属性和getter方法...
}

class ChessPieceUnitFactory
{
    private static $pieces;

    private static function initChesePiece()
    {
        if (null == self::$pieces) {
            self::$pieces = [
                1 => new ChessPieceUnit(1, '車', ChessPieceColor::BLACK()),
                2 => new ChessPieceUnit(2, '馬', ChessPieceColor::BLACK()),
            ];
        }
    }

    public static function getChessPiece(int $chessPieceId): ChessPieceUnit
    {
        self::initChesePiece();
        return self::$pieces[$chessPieceId];
    }
}

class ChessPiece
{
    private $chessPieceUnit;
    private $positionX;
    private $positionY;

    public function __construct(ChessPieceUnit $chessPieceUnit, int $positionX, int $positionY)
    {
        $this->chessPieceUnit = $chessPieceUnit;
        $this->positionX      = $positionX;
        $this->positionY      = $positionY;
    }

    // 省略getter、setter方法
}

class ChessBoard
{
    private $chessPieces;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->chessPieces[] = new ChessPiece(ChessPieceUnitFactory::getChessPiece(1), 0, 0);
        $this->chessPieces[] = new ChessPiece(ChessPieceUnitFactory::getChessPiece(2), 1, 0);

        print_r("init over".PHP_EOL);
    }

    public function move(int $chessPiceceId, int $toPositionx, int $toPositionY)
    {

    }
}

$c = new ChessBoard();

