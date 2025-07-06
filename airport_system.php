<?php
$penguinTypes = array();

while (true) {
    $input = readline("");
    
    if (trim($input) === '') {
        break;
    }
    
    $data = explode(' ', trim($input), 2);
    
    if (count($data) === 2) {
        $count = (int)$data[0];
        $type = $data[1];
        
        if (isset($penguinTypes[$type])) {
            $penguinTypes[$type] += $count;
        } else {
            $penguinTypes[$type] = $count;
        }
    }
}

$maxCount = 0;
$maxType = "";

foreach ($penguinTypes as $type => $count) {
    echo "$type: $count\n";
    
    if ($count > $maxCount) {
        $maxCount = $count;
        $maxType = $type;
    }
}

echo "Тип пингвина с наибольшей популяцией: $maxType\n";
?>