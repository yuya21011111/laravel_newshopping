<?php 

namespace App\Constants;

class Common {

    // おすすめ順
    const ORDER_RECOMMEND = '0';
    //高い順
    const ORDER_HIGHER = '1';
    //低い順
    const ORDER_LOWER = '2';
    //新しい順
    const ORDER_LATER = '3';
    //古い順
    const ORDER_OLDER = '4';

    const SORT_ORDER = [
        'recommend' => self::ORDER_RECOMMEND,
        'higherPrice' => self::ORDER_HIGHER,
        'lowerPrice' => self::ORDER_LOWER,
        'later' => self::ORDER_LATER,
        'older' => self::ORDER_OLDER,
    ];
}