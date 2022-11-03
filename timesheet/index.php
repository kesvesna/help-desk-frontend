<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Help Desk | FG</title>
    <link rel="icon" type="image/x-icon" href="../icons/repair.svg">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php

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

$date = '2022-11';

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

$month = $months[(date('m', strtotime($date)))];
$year = date('Y', strtotime($date));
?>

<main>
    <div class="container-fluid" style="padding-bottom: 15vh;">
        <div class="row col-12 mx-auto row-cols-1">
            <div class="col">
                <h5 style="color: white;" class="pt-3">Месяц и год</h5>
                <input type="month" id="start" name="start"
                       min="2022-10" value="2022-11">
            </div>
        </div>
        <h5 style="color: white;" class="pt-4 pb-3">Табель на <?=$month . ' ' . $year . ' года'?></h5>
        <table class="table table-bordered table-hover" style="background: rgba( 255, 255, 255, 0.1 );
    backdrop-filter: blur( 1px );
    -webkit-backdrop-filter: blur( 1px );
    border-radius: 5px;
    border: 1px solid rgba( 255, 255, 255, 0.18 );">
            <thead>
            <tr>
                <th scope="col" style="width: 10%;" class="d-none d-sm-table-cell">Число
                </th>
                <th scope="col" style="width: 20%;"  class="d-none d-lg-table-cell">
                    День
                </th>
                <th scope="col" style="width: 15%;"  class="d-none d-lg-table-cell">
                    Отработано, ч
                </th>
                <th scope="col" style="width: 15%;" class="d-none d-md-table-cell">
                    Переработка, ч
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach($dates as $date) {
                    $id = date('d', strtotime($date));
                    $day = $days[(date('w', strtotime($date)))];
                    $day_index = intval(date('w', strtotime($date)));
                    echo '<tr style="color: white;">';
                    if ($day_index !== 0 && $day_index !== 6) {
                        echo '<td style="background: rgba(7, 250, 7, 0.1);">' . $id . '</td>';
                        echo '<td style="background: rgba(7, 250, 7, 0.1);">' . $day . '</td>';
                        echo '<td style="background: rgba(7, 250, 7, 0.1);"><input name="hours" value="8" style="color: white; width: 30px; border: none; background-color: transparent;"></td>';
                        echo '<td style="background: rgba(7, 250, 7, 0.1);"><input name="over_time" value="0" style="color: white; width: 30px; border: none; background-color: transparent;"></td>';
                    } else {
                        echo '<td style="background: rgba(250, 7, 7, 0.1);">' . $id . '</td>';
                        echo '<td style="background: rgba(250, 7, 7, 0.1);">' . $day . '</td>';
                        echo '<td style="background: rgba(250, 7, 7, 0.1);"><input name="hours" value="0" style="color: white; width: 30px; border: none; background-color: transparent;"></td>';
                        echo '<td style="background: rgba(250, 7, 7, 0.1);"><input name="over_time" value="0" style="color: white; width: 30px; border: none; background-color: transparent;"></td>';
                    }
                    echo '</tr>';
                }
            ?>
            </tbody>
        </table>
        <div class="row col-12 mx-auto row-cols-1 row-cols-md-2 row-cols-xxl-2">
            <div class="col mt-4">
                <button class="btn btn-danger col-12" type="button">Сохранить</button>
            </div>
            <div class="col mt-4">
                <button onClick="history.back()" class="btn btn-success col-12" type="button">Назад</button>
            </div>
        </div>
    </div>
    <div class="collapse fixed-bottom mx-auto bottom-menu-block" id="navbarToggleExternalContent">
        <div class="pt-3 pb-3 d-flex align-items-center bottom-menu-block-child">
            <a class="nav-link" href="../chat/index.html"><h5>Чат заявок</h5></a>
            <a class="nav-link" href="../application/index.html"><h5>Заявки</h5></a>
            <a class="nav-link" href="../repair/index.html"><h5>Ремонт</h5></a>
            <a class="nav-link" href="../act/index.html"><h5>Акты</h5></a>
            <a class="nav-link" href="../admin/index.html"><h5>Админ панель</h5></a>
        </div>
    </div>
</main>
<footer>
    <nav class="navbar fixed-bottom justify-content-around">
        <a href="../index.html" class="btn">
            <img src="../icons/home.svg" alt="Profile icon" width="30" height="30">
        </a>
        <button class="navbar-toggler btn" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <button onClick="history.back()" class="btn">
            <img src="../icons/back.svg" alt="Profile icon" width="30" height="30">
        </button>
    </nav>
</footer>
<script defer src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script defer src="../js/jquery.min.js"></script>
</body>
</html>
