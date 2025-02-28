<?php
header('Content-Type: image/png');

// Создаем изображение
$img = imagecreate(120, 50);
$bg = imagecolorallocate($img, 255, 255, 255); // Белый фон
$black = imagecolorallocate($img, 0, 0, 0);    // Черный цвет

// Генерируем 4 случайных символа
$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$code = '';
for ($i = 0; $i < 4; $i++) {
    $code .= $chars[rand(0, 35)];
}

// Добавляем символы с наклоном и разным положением
$x = 10;
for ($i = 0; $i < 4; $i++) {
    $angle = rand(-15, 15); // Случайный угол наклона
    $y = rand(15, 35);      // Случайное положение по Y
    imagettftext(
        $img,
        20,           // Размер шрифта
        $angle,       // Угол наклона
        $x,           // Позиция X
        $y,           // Позиция Y
        $black,
        'Roboto-Regular.ttf',  // Путь к шрифту (нужен файл arial.ttf)
        $code[$i]
    );
    $x += 25;
}

// Добавляем 3 линии
for ($i = 0; $i < 3; $i++) {
    imageline($img, rand(0, 120), rand(0, 50), rand(0, 120), rand(0, 50), $black);
}

// Добавляем 3 точки
for ($i = 0; $i < 3; $i++) {
    imagesetpixel($img, rand(0, 120), rand(0, 50), $black);
}

// Выводим
imagepng($img);
imagedestroy($img);
?>