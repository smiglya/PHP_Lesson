<?php
class Animal {
    protected $name;
    protected $age;
    
    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getAge() {
        return $this->age;
    }
    
    public function displayInfo() {
        echo "Имя: " . $this->name . "\n";
        echo "Возраст: " . $this->age . "\n";
    }
    
    public function speak() {
        echo $this->name . " говорит: Звук животного!\n";
    }
}

class Dog extends Animal {
    public function speak() {
        echo $this->name . " говорит: Гав-гав!\n";
    }
}

class Cat extends Animal {
    public function speak() {
        echo $this->name . " говорит: Мяу-мяу!\n";
    }
}

// Основная программа
$name = readline();
$age = readline();
$type = readline();

// Создание объекта в зависимости от типа
if ($type === "Dog") {
    $pet = new Dog($name, $age);
} elseif ($type === "Cat") {
    $pet = new Cat($name, $age);
} else {
    $pet = new Animal($name, $age);
}

// Вывод информации о питомце
$pet->displayInfo();
$pet->speak();

?>