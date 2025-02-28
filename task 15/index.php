<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
            background-color: #f0f0f0;
        }

        .calendar {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-header a {
            padding: 8px 16px;
            font-size: 16px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
        }

        .calendar-header a:hover {
            background-color: #45a049;
        }

        .calendar-month-year {
            font-size: 24px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .today {
            background-color: #ffeb3b;
            font-weight: bold;
        }

        .empty {
            background-color: #fff;
        }
    </style>
</head>
<body>
<div class="calendar">
    <?php
    // Получаем текущий месяц и год из GET-запроса или текущую дату
    $currentMonth = isset($_GET['month']) ? (int)$_GET['month'] : date('n') - 1; // Используем date('n') для 1-12
    $currentYear = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

    // Корректируем месяц, если он выходит за пределы
    if ($currentMonth < 0) {
        $currentMonth = 11;
        $currentYear--;
    } elseif ($currentMonth > 11) {
        $currentMonth = 0;
        $currentYear++;
    }

    // Функция для генерации календаря
    function generateCalendar($year, $month) {
        $today = new DateTime();
        $calendar = new DateTime("$year-" . ($month + 1) . "-01"); // +1, так как PHP использует 1-12
        $monthName = $calendar->format('F Y'); // Название месяца и год

        // Вывод заголовка
        echo "<div class='calendar-header'>";
        echo "<a href='?month=" . ($month - 1) . "&year=" . ($month == 0 ? $year - 1 : $year) . "'>←</a>";
        echo "<div class='calendar-month-year'>$monthName</div>";
        echo "<a href='?month=" . ($month + 1) . "&year=" . ($month == 11 ? $year + 1 : $year) . "'>→</a>";
        echo "</div>";

        // Создаем таблицу
        echo "<table><thead><tr>";
        $days = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
        foreach ($days as $day) {
            echo "<th>$day</th>";
        }
        echo "</tr></thead><tbody>";

        // Получаем первый день месяца и количество дней
        $firstDay = (int)$calendar->format('N') - 1; // 0 (Пн) - 6 (Вс)
        $daysInMonth = (int)$calendar->format('t');

        // Заполняем пустыми ячейками перед началом месяца
        echo "<tr>";
        for ($i = 0; $i < $firstDay; $i++) {
            echo "<td class='empty'></td>";
        }

        // Заполняем днями месяца
        for ($day = 1; $day <= $daysInMonth; $day++) {
            if (($firstDay + $day - 1) % 7 === 0 && $day > 1) {
                echo "</tr><tr>";
            }
            $date = new DateTime("$year-" . ($month + 1) . "-$day");
            $class = $date->format('Y-m-d') === $today->format('Y-m-d') ? 'today' : '';
            echo "<td class='$class'>$day</td>";
        }

        // Заполняем пустыми ячейками после конца месяца
        while (($firstDay + $daysInMonth) % 7 !== 0) {
            echo "<td class='empty'></td>";
            $daysInMonth++;
        }
        echo "</tr></tbody></table>";
    }

    // Генерируем календарь
    generateCalendar($currentYear, $currentMonth);
    ?>
</div>
</body>
</html>