<?php

// Интерфейсы
interface Attackable {
    public function attack();
}

interface Defendable {
    public function defend();
}

interface Interactable {
    public function interact();
}

// Трейты
trait MagicUser {
    public function useMagic() {
        return "используя магию";
    }
}

trait WarriorSkills {
    public function useWarriorSkills() {
        return "как воин";
    }
}

// Базовый класс для оружия
class Weapon {
    protected $name;
    protected $type;
    
    public function __construct($name, $type) {
        $this->name = $name;
        $this->type = $type;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getType() {
        return $this->type;
    }
}

// Классы оружия
class Sword extends Weapon {
    public function __construct($name) {
        parent::__construct($name, "Sword");
    }
}

class Staff extends Weapon {
    public function __construct($name) {
        parent::__construct($name, "Staff");
    }
}

// Базовый класс для объектов окружения
class EnvironmentObject {
    protected $name;
    protected $type;
    protected $state;
    
    public function __construct($name, $type) {
        $this->name = $name;
        $this->type = $type;
        $this->state = "Закрыт";
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function getState() {
        return $this->state;
    }
    
    public function displayInfo() {
        echo $this->name . " (" . $this->type . ") - Состояние: " . $this->state . "\n";
    }
}

// Классы объектов окружения
class Chest extends EnvironmentObject {
    public function __construct($name) {
        parent::__construct($name, "Chest");
    }
}

class Door extends EnvironmentObject {
    public function __construct($name) {
        parent::__construct($name, "Door");
    }
}

// Класс инвентаря
class Inventory {
    private $items = [];
    
    public function addItem($item) {
        $this->items[] = $item;
    }
    
    public function displayItems() {
        echo "Инвентарь: ";
        foreach ($this->items as $item) {
            echo $item->getName() . " (" . $item->getType() . ")";
            if ($item !== end($this->items)) {
                echo ", ";
            }
        }
        echo "\n";
    }
}

// Класс квеста
class Quest {
    private $name;
    private $steps;
    
    public function __construct($name, $steps) {
        $this->name = $name;
        $this->steps = $steps;
    }
    
    public function displayQuest() {
        echo "Квест: " . $this->name . "\n";
        echo "Этапы квеста:\n";
        for ($i = 0; $i < count($this->steps); $i++) {
            echo ($i + 1) . ". " . $this->steps[$i] . "\n";
        }
    }
}

// Базовый класс персонажа
class Character implements Attackable, Defendable, Interactable {
    protected $name;
    protected $type;
    protected $strength;
    protected $agility;
    protected $intelligence;
    protected $weapon;
    protected $inventory;
    
    public function __construct($name, $type) {
        $this->name = $name;
        $this->type = $type;
        $this->inventory = new Inventory();
        $this->setDefaultAttributes();
    }
    
    protected function setDefaultAttributes() {
        $this->strength = 5;
        $this->agility = 5;
        $this->intelligence = 5;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function setWeapon($weapon) {
        $this->weapon = $weapon;
        $this->inventory->addItem($weapon);
    }
    
    public function displayInfo() {
        echo "Персонаж: " . $this->name . " (" . $this->type . ")\n";
        echo "Атрибуты: Сила - " . $this->strength . ", Ловкость - " . $this->agility . ", Интеллект - " . $this->intelligence . "\n";
        if ($this->weapon) {
            echo "Оружие: " . $this->weapon->getName() . " (" . $this->weapon->getType() . ")\n";
        }
        $this->inventory->displayItems();
    }
    
    public function attack() {
        echo $this->name . " атакует с " . $this->weapon->getName() . "!\n";
    }
    
    public function defend() {
        echo $this->name . " защищается!\n";
    }
    
    public function interact() {
        echo $this->name . " взаимодействует с окружением!\n";
    }
}

// Класс воина
class Warrior extends Character {
    use WarriorSkills;
    
    public function __construct($name) {
        parent::__construct($name, "Warrior");
        $this->strength = 10;
        $this->agility = 5;
        $this->intelligence = 3;
    }
    
    public function attack() {
        echo $this->name . " атакует с " . $this->weapon->getName() . " " . $this->useWarriorSkills() . "!\n";
    }
}

// Класс мага
class Mage extends Character {
    use MagicUser;
    
    public function __construct($name) {
        parent::__construct($name, "Mage");
        $this->strength = 3;
        $this->agility = 5;
        $this->intelligence = 10;
    }
    
    public function attack() {
        echo $this->name . " атакует с " . $this->weapon->getName() . " " . $this->useMagic() . "!\n";
    }
}

// Класс боя
class Battle {
    public function startBattle($character1, $character2) {
        echo "Начинается бой между " . $character1->getName() . " и " . $character2->getName() . "!\n";
        $character1->attack();
        $character2->defend();
    }
}

// Основная программа
$characterName = readline();
$characterType = readline();
$weaponName = readline();
$weaponType = readline();
$objectName = readline();
$objectType = readline();
$questName = readline();
$questSteps = readline();

// Создание персонажа
if ($characterType === "Warrior") {
    $character = new Warrior($characterName);
} elseif ($characterType === "Mage") {
    $character = new Mage($characterName);
} else {
    $character = new Character($characterName, $characterType);
}

// Создание оружия
if ($weaponType === "Sword") {
    $weapon = new Sword($weaponName);
} elseif ($weaponType === "Staff") {
    $weapon = new Staff($weaponName);
} else {
    $weapon = new Weapon($weaponName, $weaponType);
}

// Создание объекта окружения
if ($objectType === "Chest") {
    $environmentObject = new Chest($objectName);
} elseif ($objectType === "Door") {
    $environmentObject = new Door($objectName);
} else {
    $environmentObject = new EnvironmentObject($objectName, $objectType);
}

// Создание квеста
$stepsArray = explode(", ", $questSteps);
$quest = new Quest($questName, $stepsArray);

// Настройка персонажа
$character->setWeapon($weapon);

// Вывод информации
$character->displayInfo();
$environmentObject->displayInfo();
$quest->displayQuest();
$character->attack();

?>
