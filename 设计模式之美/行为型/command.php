<?php
interface Command{
    function execute();
}

class GotDiamondCommand implements Command
{
    public function __construct(/*数据*/)
    {
        //...
    }

    public function execute()
    {
        // 执行相应的逻辑
    }
}
//GotStartCommand/HitObstacleCommand/ArchiveCommand类省略
class GameApplication{
     private $MAX_HANDLED_REQ_COUNT_PER_LOOP = 100;
     private $queue;

     public function mainloop()
     {
         while (true)
         {
             $requests = [];

             //省略从epoll或者select中获取数据，并封装成Request的逻辑，
             //注意设置超时时间，如果很长时间没有接收到请求，就继续下面的逻辑处理。

             foreach ($requests as $request) {
                 $event = $request->getEvent();
                 $command = null;
                 if (Event.GOT_DIAMOND)
                 {
                     $command = new GotDiamondCommand(/*数据*/);
                 }elseif(Event.GOT_STAR)
                 {
                     $command = new GoStartCommand(/*数据*/);
                 }elseif(Event.HIT_OBSTACLE)
                 {
                     $command = new HitObstacleCommand(/*数据*/);
                 }
                 $this->queue[] = $command; //array_push($queue, $command)
             }

             $handledCount = 0;
             while($handledCount < $this->MAX_HANDLED_REQ_COUNT_PER_LOOP)
             {
                 if (empty($this->queue))
                     break;
                 $command = array_shift($this->queue);
                 $command->execute();
             }

         }
     }

}
