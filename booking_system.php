<?php
while (true) {
    // Ввод данных
    $name = readline("");
    $email = readline("");
    $datetime = readline("");
    $guests = readline("");
    $wishes = readline("");
    
    // Массив для хранения ошибок
    $errors = array();
    
    // Валидация email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strpos($email, '@') === false || strpos($email, '.') === false) {
        $errors[] = "Некорректный формат email";
    }
    
    // Валидация количества гостей
    $guestsNum = (int)$guests;
    if ($guestsNum <= 0) {
        if ($guestsNum == 0) {
            $errors[] = "Количество гостей обязательно";
        } else {
            $errors[] = "Введите корректное количество гостей";
        }
    }
    
    // Вывод результата
    if (empty($errors)) {
        // Успешное бронирование
        echo "Ваше бронирование успешно создано!\n";
        echo "Имя: $name\n";
        echo "Email: $email\n";
        echo "Дата и время: $datetime\n";
        echo "Количество гостей: $guestsNum\n";
        echo "Специальные пожелания: $wishes\n";
    } else {
        // Есть ошибки
        foreach ($errors as $error) {
            echo "$error\n";
        }
        echo "Пожалуйста, исправьте ошибки и попробуйте снова.\n";
    }
    
    // Спрашиваем о продолжении
    $continue = readline("");
    if (trim(strtolower($continue)) === 'нет') {
        break;
    }
}
?> 