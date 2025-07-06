<?php
$brands = array();

while (true) {
    $input = readline("");
    
    if (trim($input) === '') {
        break;
    }
    
    // Разделяем по запятым и убираем лишние пробелы
    $data = array_map('trim', explode(',', trim($input)));
    
    if (count($data) === 5) {
        $date = $data[0];
        $brand = $data[1];
        $model = $data[2];
        $quantity = (int)$data[3];
        $revenue = (int)$data[4];
        
        // Инициализируем данные марки если их еще нет
        if (!isset($brands[$brand])) {
            $brands[$brand] = array(
                'totalRevenue' => 0,
                'totalQuantity' => 0
            );
        }
        
        // Добавляем к общим показателям марки
        $brands[$brand]['totalRevenue'] += $revenue;
        $brands[$brand]['totalQuantity'] += $quantity;
    }
}

// Находим марку с максимальной выручкой
$maxRevenue = 0;
$maxBrand = "";

foreach ($brands as $brand => $data) {
    $totalRevenue = $data['totalRevenue'];
    $totalQuantity = $data['totalQuantity'];
    $averagePerUnit = round($totalRevenue / $totalQuantity);
    
    echo "$brand: общая выручка $totalRevenue, средняя выручка на единицу $averagePerUnit\n";
    
    if ($totalRevenue > $maxRevenue) {
        $maxRevenue = $totalRevenue;
        $maxBrand = $brand;
    }
}

echo "Марка с наибольшей выручкой: $maxBrand\n";
?>