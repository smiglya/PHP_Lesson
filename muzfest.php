<?php

// Интерфейс для игры на инструменте
interface Playable {
    public function playInstrument();
}

// Трейт для настройки инструмента
trait Tunable {
    public function tuneInstrument() {
        echo "Инструмент настроен\n";
    }
}

// Базовый класс для инструментов
class Instrument {
    protected $type;
    
    public function __construct($type) {
        $this->type = $type;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function tune() {
        echo $this->type . " настроен.\n";
    }
}

// Класс для гитары
class Guitar extends Instrument {
    public function __construct() {
        parent::__construct("Guitar");
    }
}

// Класс для барабанов
class Drum extends Instrument {
    public function __construct() {
        parent::__construct("Drum");
    }
}

// Класс для скрипки
class Violin extends Instrument {
    public function __construct() {
        parent::__construct("Violin");
    }
}

// Базовый класс для музыкантов
class Musician implements Playable {
    use Tunable;
    
    protected $name;
    protected $age;
    protected $instrument;
    
    public function __construct($name, $age, $instrument) {
        $this->name = $name;
        $this->age = $age;
        $this->instrument = $instrument;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getAge() {
        return $this->age;
    }
    
    public function getInstrument() {
        return $this->instrument;
    }
    
    public function displayInfo() {
        echo "Имя: " . $this->name . "\n";
        echo "Возраст: " . $this->age . "\n";
        echo "Инструмент: " . $this->instrument->getType() . "\n";
    }
    
    public function playInstrument() {
        echo $this->name . " играет на инструменте!\n";
    }
}

// Класс для гитариста
class Guitarist extends Musician {
    public function playInstrument() {
        echo $this->name . " играет на гитаре!\n";
    }
}

// Класс для барабанщика
class Drummer extends Musician {
    public function playInstrument() {
        echo $this->name . " играет на барабанах!\n";
    }
}

// Класс для скрипача
class Violinist extends Musician {
    public function playInstrument() {
        echo $this->name . " играет на инструменте!\n";
    }
}

// Основная программа
$name = readline();
$age = readline();
$musicianType = readline();
$instrumentType = readline();

// Создание инструмента
if ($instrumentType === "Guitar") {
    $instrument = new Guitar();
} elseif ($instrumentType === "Drum") {
    $instrument = new Drum();
} elseif ($instrumentType === "Violin") {
    $instrument = new Violin();
} else {
    $instrument = new Instrument($instrumentType);
}

// Создание музыканта
if ($musicianType === "Guitarist") {
    $musician = new Guitarist($name, $age, $instrument);
} elseif ($musicianType === "Drummer") {
    $musician = new Drummer($name, $age, $instrument);
} elseif ($musicianType === "Violinist") {
    $musician = new Violinist($name, $age, $instrument);
} else {
    $musician = new Musician($name, $age, $instrument);
}

// Вывод информации
$musician->displayInfo();
$instrument->tune();
$musician->tuneInstrument();
$musician->playInstrument();

?>
