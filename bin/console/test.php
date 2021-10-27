<?php


include (dirname(__FILE__) . '\..\Helper\DateHelper.php');


$date = getopt("", array("date:"));
$limit = getopt("", array("limit:"));

if (!isset($date['date'])) {
    $stdin = fopen("php://stdin", "r");
    echo 'Введите дату (Date - дата в формате Y-m-d):';
    $date = stream_get_contents($stdin, 10);
} else {
    $date = $date['date'];
}

if (!isset($limit['limit'])) {
    $stdin = fopen("php://stdin", "r");
    echo 'Введите лимит (Limit - целочисленное значение больше 0, но меньше 1000):';
    $limit = stream_get_contents($stdin, 3);
} else {
    $limit = $limit['limit'];
}


if (DateHelper::validateDate($date) && $limit > 0) {
    $dates = DateHelper::getDates($date, $limit);

    foreach ($dates as $date) {
        echo $date . "\n";
    }
} else {
    echo 'Ошибка входных параметров!';
}




