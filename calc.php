<?php

// Пользовательский класс исключений для калькулятора
class CalculatorException extends Exception {

}

// Класс калькулятора
class Calculator {
    
    // Функция для проверки, является ли строка числом
    private function isNumeric($value) {
        return is_numeric($value);
    }
    
    // Функция для валидации числа
    private function validateNumber($value) {
        if (!$this->isNumeric($value)) {
            throw new CalculatorException("Некорректный ввод. Пожалуйста, введите число.");
        }
        return floatval($value);
    }
    
    // Функция для сложения
    private function add($a, $b) {
        return $a + $b;
    }
    
    // Функция для вычитания
    private function subtract($a, $b) {
        return $a - $b;
    }
    
    // Функция для умножения
    private function multiply($a, $b) {
        return $a * $b;
    }
    
    // Функция для деления
    private function divide($a, $b) {
        if ($b == 0) {
            throw new CalculatorException("Деление на ноль.");
        }
        return $a / $b;
    }
    
    // Главная функция для выполнения операции
    public function calculate($num1, $num2, $operation) {
        try {
            // Валидация чисел
            $number1 = $this->validateNumber($num1);
            $number2 = $this->validateNumber($num2);
            
            // Выполнение операции
            switch ($operation) {
                case '+':
                    $result = $this->add($number1, $number2);
                    break;
                case '-':
                    $result = $this->subtract($number1, $number2);
                    break;
                case '*':
                    $result = $this->multiply($number1, $number2);
                    break;
                case '/':
                    $result = $this->divide($number1, $number2);
                    break;
                default:
                    throw new CalculatorException("Неверная операция.");
            }
            
            // Форматирование результата (убираем лишние нули)
            if (is_int($result) || $result == intval($result)) {
                return intval($result);
            }
            return $result;
            
        } catch (CalculatorException $e) {
            throw $e;
        }
    }
}

// Основная программа
$calculator = new Calculator();

try {
    // Получаем входные данные
    $num1 = readline();
    $num2 = readline();
    $operation = readline();
    
    // Выполняем вычисление
    $result = $calculator->calculate($num1, $num2, $operation);
    
    // Выводим результат
    echo "Результат: " . $result . "\n";
    
} catch (CalculatorException $e) {
    echo "Ошибка: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "Неожиданная ошибка: " . $e->getMessage() . "\n";
}

?>