<?php
class Athlete {
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
    
    public function performAction() {
        echo $this->name . " занимается спортом\n";
    }
}

class Runner extends Athlete {
    public function performAction() {
        echo $this->name . " бежит\n";
    }
}

class Swimmer extends Athlete {
    public function performAction() {
        echo $this->name . " плавает\n";
    }
}

class Cyclist extends Athlete {
    public function performAction() {
        echo $this->name . " едет на велосипеде\n";
    }
}

// Основная программа
$name = readline();
$age = readline();
$sport = readline();

// Создание объекта в зависимости от вида спорта
if ($sport === "Runner") {
    $athlete = new Runner($name, $age);
} elseif ($sport === "Swimmer") {
    $athlete = new Swimmer($name, $age);
} elseif ($sport === "Cyclist") {
    $athlete = new Cyclist($name, $age);
} else {
    $athlete = new Athlete($name, $age);
}

// Вывод информации о спортсмене
$athlete->displayInfo();
$athlete->performAction();

?>