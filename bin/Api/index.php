<?php

include (dirname(__FILE__) . '\..\Helper\DateHelper.php');

$date = $_GET['date'];
$limit = (int) $_GET['limit'];
$feedback_format = $_GET['format'];


if ($limit < 0 || !DateHelper::validateDate($date)) {
    return json_encode('Неверно указаны входные параметры');
}

$dates = DateHelper::getDates($date, $limit);

if ($feedback_format == 'json') {
    return json_encode($dates);

} else if ($feedback_format == 'xml') {
    $xml = simplexml_load_file('test.xml');
    foreach ($dates as $date) {
        $xml->addChild('date', $date);
    }

    $xml->saveXML('test1.xml');
    $file = 'test1.xml';

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
    }
}
