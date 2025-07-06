<?php
echo "=== Система управления ресторанами ===\n";
echo "Введите данные о заказах (количество блюд и сумма заказа через пробел).\n";
echo "Для завершения ввода нажмите Enter без ввода данных.\n\n";

$orderNumber = 1;

while (true) {
    $input = readline("Заказ $orderNumber: ");
    
    if (trim($input) === '') {
        break;
    }
    
    $data = explode(' ', trim($input));
    
    if (count($data) === 2) {
        $dishes = (int)$data[0];
        $amount = (float)$data[1];
        
        // Проверка скидки: четное количество блюд И сумма >= 1000
        if ($dishes % 2 === 0 && $amount >= 1000) {
            echo "Заказ $orderNumber: скидка\n";
        } else {
            echo "Заказ $orderNumber: без скидки\n";
        }
        
        $orderNumber++;
    } else {
        echo "Неверный формат! Используйте: количество_блюд сумма_заказа\n";
    }
}
?> 