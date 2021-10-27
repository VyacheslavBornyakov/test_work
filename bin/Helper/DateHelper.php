<?php

class DateHelper
{
    public static function getDates(string $date, int $limit): array {
        $date = date('Y-m-d', strtotime($date));

        $dates = [];
        for ($i = 0; $i < $limit; $i++) {
            $dates[] = date('Y-m-d', strtotime($date. ' + '. $i .' days'));
        }

        return $dates;
    }

    public static function validateDate(string $date) : bool {
        $params = explode('-', $date, 3);
        return checkdate($params[1], $params[2], $params[0]);
    }
}
