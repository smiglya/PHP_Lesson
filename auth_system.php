<?php
// Функция для аутентификации пользователя
function authenticate($username, $password) {
    // Пример хранения пользователей (в реальной системе используйте базу данных)
    $valid_username = 'admin';
    $valid_password = 'password';

    return ($username === $valid_username && $password === $valid_password);
}

// Ввод данных пользователя
$username = readline("");
$password = readline("");

// Проверка аутентификации
if (authenticate($username, $password)) {
    echo "Вход выполнен успешно. Добро пожаловать, $username!\n";
    
    // Опция "Запомнить меня"
    $remember = readline("");
    
    // Решение о выходе
    $logout = readline("");
    
    if (trim(strtolower($logout)) === 'да') {
        echo "Вы вышли из системы.\n";
    }
} else {
    echo "Неправильное имя пользователя или пароль.\n";
    
    // Читаем опцию запоминания, но не используем для неуспешного входа
    $remember = readline("");
}
?> 