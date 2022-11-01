<?php

declare(strict_types=1);

function getBetweenDates($startDate, $endDate)
{
    $rangArray = [];

    $startDate = strtotime($startDate);
    $endDate = strtotime($endDate);

    for ($currentDate = $startDate; $currentDate <= $endDate;
         $currentDate += (86400)) {

        $date = date('Y-m-d', $currentDate);
        $rangArray[] = $date;
    }

    return $rangArray;
}


function getFirstDay($date)
{
    $month = intval(date('m', strtotime($date)));
    $year = intval(date('Y', strtotime($date)));

    return $year . "-" . $month . "-01";
}

function getLastDay($date)
{
    $month = intval(date('m', strtotime($date)));
    $year = intval(date('Y', strtotime($date)));

    $days_count = cal_days_in_month(0, $month, $year);

    return $year . "-" . $month . "-" . $days_count;
}

$date = '2022-02';

$first_day = getFirstDay($date);
$last_day = getLastDay($date);

$dates = getBetweenDates($first_day, $last_day);

$days = [
    'Воскресенье',
    'Понедельник',
    'Вторник',
    'Среда',
    'Четверг',
    'Пятница',
    'Суббота'
];

echo($days[(date('w'))] . date(', H:i'));


foreach($dates as $date) {
    echo date('F', (strtotime($date))) . '<br><br>';
    break;
}

foreach($dates as $date) {
    echo date('j \ - \(l\)', strtotime($date)) . '<br>';
}