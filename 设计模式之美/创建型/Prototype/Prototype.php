<?php

//class Demo
//{
//
//    private $currentKeyWords = [
//        'a2020' => [],
//        'a2021' => []
//    ];
//    private $lastUpdateTime = -1;
//
//    public function getCurrentKeyWords()
//    {
//        print_r($this->currentKeyWords);
//        return $this->currentKeyWords;
//    }
//
//    public function refresh()
//    {
//        // 从数据库中取出更新时间>lastUpdateTime的数据，放入到currentKeywords中
//        $toBeUpdatedSearchWords = $this->getSearchWords($this->lastUpdateTime);
//        $maxNewUpdatedTime      = $this->lastUpdateTime;
//        foreach ($toBeUpdatedSearchWords as $searchWord) {
//            if ($searchWord['lastUpdateTime'] > $maxNewUpdatedTime) {
//                $maxNewUpdatedTime = $searchWord['lastUpdateTime'];
//            }
//            $this->currentKeyWords[$searchWord['keyWords']] = $searchWord;
//        }
//
//        $this->lastUpdateTime = $maxNewUpdatedTime;
//    }
//
//
//    private function getSearchWords($lastUpdateTime)
//    {
//        // TODO: 从数据库中取出更新时间>lastUpdateTime的数据
//        return [
//            [
//                'keyWords'       => 'a2020',
//                'searchCount'    => 100,
//                'lastUpdateTime' => 123,
//            ],
//            [
//                'keyWords'       => 'a2021',
//                'searchCount'    => 200,
//                'lastUpdateTime' => 223,
//            ],
//        ];
//    }
//
//}


//$demo = new Demo();
//$demo->getCurrentKeyWords();
//$demo->refresh();
//$demo->getCurrentKeyWords();


//class Demo
//{
//
//    private $currentKeyWords = [
//        'a2020' => [],
//        'a2021' => []
//    ];
//    private $lastUpdateTime = -1;
//
//    public function getCurrentKeyWords()
//    {
//        print_r($this->currentKeyWords);
//        return $this->currentKeyWords;
//    }
//
//    public function refresh()
//    {
//        $newKeywords = [];
//        $toBeUpdatedSearchWords = $this->getSearchWords($this->lastUpdateTime);
//
//        foreach ($toBeUpdatedSearchWords as $searchWord) {
//            $newKeywords = $searchWord;
//        }
//        $this->currentKeyWords = $newKeywords;
//    }
//
//
//    private function getSearchWords($lastUpdateTime)
//    {
//        // TODO: 从数据库中取出所有的数据
//        return [
//            [
//                'keyWords'       => 'a2020',
//                'searchCount'    => 100,
//                'lastUpdateTime' => 123,
//            ],
//            [
//                'keyWords'       => 'a2021',
//                'searchCount'    => 200,
//                'lastUpdateTime' => 223,
//            ],
//        ];
//    }
//
//}

