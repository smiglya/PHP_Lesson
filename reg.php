<?php

// Пользовательский класс исключений для регистрации
class RegistrationException extends Exception {

}

// Класс для валидации данных
class Validator {
    
    // Проверка имени (только буквы)
    public function validateName($name) {
        // Проверяем, что имя содержит только буквы (включая кириллицу)
        if (!preg_match('/^[a-zA-ZАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя\s]+$/u', $name)) {
            throw new RegistrationException("Имя должно содержать только буквы.");
        }
        return true;
    }
    
    // Проверка возраста (положительное число)
    public function validateAge($age) {
        // Проверяем, что возраст является числом
        if (!is_numeric($age)) {
            throw new RegistrationException("Возраст должен быть положительным числом.");
        }
        
        $ageValue = intval($age);
        
        // Проверяем, что возраст положительный
        if ($ageValue <= 0) {
            throw new RegistrationException("Возраст должен быть положительным числом.");
        }
        
        return $ageValue;
    }
    
    // Проверка email (правильный формат)
    public function validateEmail($email) {
        // Проверяем формат email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new RegistrationException("Некорректный формат email.");
        }
        return true;
    }
}

// Класс пользователя
class User {
    private $name;
    private $age;
    private $email;
    
    public function __construct($name, $age, $email) {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getAge() {
        return $this->age;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function displayInfo() {
        echo "Регистрация успешна!\n";
        echo "Имя: " . $this->name . "\n";
        echo "Возраст: " . $this->age . "\n";
        echo "Email: " . $this->email . "\n";
    }
}

// Класс системы регистрации
class RegistrationSystem {
    private $validator;
    
    public function __construct() {
        $this->validator = new Validator();
    }
    
    public function registerUser($name, $age, $email) {
        try {
            // Валидация данных
            $this->validator->validateName($name);
            $validatedAge = $this->validator->validateAge($age);
            $this->validator->validateEmail($email);
            
            // Создание пользователя
            $user = new User($name, $validatedAge, $email);
            
            // Вывод информации о регистрации
            $user->displayInfo();
            
        } catch (RegistrationException $e) {
            echo "Ошибка: " . $e->getMessage() . "\n";
        } catch (Exception $e) {
            echo "Неожиданная ошибка: " . $e->getMessage() . "\n";
        }
    }
}

// Основная программа
$registrationSystem = new RegistrationSystem();

// Получение входных данных
$name = readline();
$age = readline();
$email = readline();

// Попытка регистрации
$registrationSystem->registerUser($name, $age, $email);

?>
