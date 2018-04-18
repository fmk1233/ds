<?php

/**
 * User: denn
 * Date: 2017/3/1
 * Time: 22:39
 */
class DateHelper
{


    /**
     * 获取某一天的时间间隔
     * @param int $num 0:表示当天的时间，1：表示明天的时间，-表示昨天的时间
     * @return array
     */
    public static function getDayTime($num = 0)
    {
        $now_day = strtotime(date('Y-m-d'));
        $begin_time = $now_day + $num * 86400;
        $end_time = $begin_time +  86400 - 1;

        return array('begin' => $begin_time, 'end' => $end_time);
    }

    /**
     * 获取某一月的时间间隔
     * @param int $num 0:表示当月的时间
     * @return array
     */
    public static function getMonthTime($num = 0)
    {
        $end_time = strtotime(date('Y-m-01').($num+1<0?' ':' + ').($num+1).' month')-1;
        $begin_time = strtotime(date('Y-m-01').($num<0?' ':' + ').$num.' month');
        return array('begin' => $begin_time, 'end' => $end_time);
    }

    /**
     * 获取某一周的时间间隔
     * @param int $num 0:表示当周的时间
     * @return array
     */
    public static function getWeekTime($num=0)
    {
        $current_time = strtotime(date('Y-m-d'));
        $n = date('N',$current_time);//一周的星期几，星期一为1
        $return_arr['begin'] =  $current_time-86400*($n - 1) + ($num)*7*86400;
        $return_arr['end'] =  $return_arr['begin'] + 7*86400-1;
        return $return_arr;

    }

    public static function getCurrentWeekDayTime()
    {
        $current_time = strtotime(date('Y-m-d'));
        $begin = $current_time-86400*(date('N',$current_time) - 1);
        for($i=0;$i<7;$i++){
            $week[] = $begin+86400*$i;
        }
        return $week;
    }

}