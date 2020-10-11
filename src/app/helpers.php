<?php

/**
 * ステップを終了するのに必要な目安時間を紐づくステージの目安時間を全て合計した値を算出
 *
 *
 */


/**
 * ステージの配列を受け取り、それぞれの目安時間を合計して返す
 *
 * @param array $stages ステップに紐づくステージ配列
 * @return int 合計の目安達成時間
 */

if (!function_exists('getTotalClearTime')) {
    function getTotalClearTime($stages): int
    {
        $total_clear_time = 0;
        foreach ($stages as $val) {
            $total_clear_time += intval($val->time);
        };
        return $total_clear_time;
    }
}
