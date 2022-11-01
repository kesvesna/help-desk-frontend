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

$months = [
    'null',
    'Январь',
    'Февраль',
    'Март',
    'Апрель',
    'Май',
    'Июнь',
    'Июль',
    'Август',
    'Сентябрь',
    'Октябрь',
    'Ноябрь',
    'Декабрь'
];

$month = $months[(date('w', strtotime($date)))];
$year = date('Y', strtotime($date));

echo 'Табель на ' . $month . ' ' . $year . ' года.' . '<br><br>';


foreach($dates as $date) {
    $day = date('d', strtotime($date)) . ' - ' . $days[(date('w', strtotime($date)))];
    $day_index = intval(date('w', strtotime($date)));
    if ($day_index !== 0 && $day_index !== 6) {
        echo '<input disabled name="day" value="' . $day . '" style="width: 150px; border: none; background-color: lightgreen;" >';
        echo ' отработано часов ' . '<input name="hours" value="8" style="width: 30px; border: none; background-color: lightgreen;">' . ' переработка ' . '<input name="over_time" value="0" style="width: 30px; border: none; background-color: lightgreen;">' . '<br>';
    } else {
        echo '<input disabled name="day" value="' . $day . '" style="width: 150px; border: none; background-color: lightpink;" >';
        echo ' отработано часов ' . '<input name="hours" value="0" style="width: 30px; border: none; background-color: lightpink;">' . ' переработка ' . '<input name="over_time" value="0" style="width: 30px; border: none; background-color: lightpink;">' . '<br>';
    }
}