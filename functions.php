<?php
require_once('data.php');

function buildSortUrl($currentSorts, $column)
{
    // Отримуємо значення сортування для поточного стовпця
    $currentSort = isset($currentSorts[$column]) ? $currentSorts[$column] : null;

    // Змінюємо порядок сортування для наступного кліку
    $nextSort = ($currentSort === 'asc') ? 'desc' : 'asc';

    // Побудова URL-посилання з урахуванням поточних параметрів сортування
    return http_build_query(array_merge($currentSorts, [$column => $nextSort]));
}


// Поточний стан сортування (може бути отримано з параметрів URL)
$currentSorts = [
    'city' => 'asc',
    'name' => 'asc',
    'country' => 'asc',
    'price' => 'asc',
];


// Перевірка, чи були передані параметри сортування через URL
if (!empty($_GET)) {
    foreach ($_GET as $key => $value) {
        // Перевірка, чи параметр є одним із стовпців для сортування
        if (in_array($key, ['city', 'name', 'country', 'price'])) {
            // Встановлення напрямку сортування для відповідного стовпця
            $currentSorts[$key] = $value;
        }
    }
}

// Сортування за вказаними критеріями
usort($arr, function($a, $b) use ($currentSorts) {
    foreach ($currentSorts as $column => $direction) {
        $valueA = ($column === 'price') ? intval($a[$column]) : $a[$column];
        $valueB = ($column === 'price') ? intval($b[$column]) : $b[$column];

        if ($valueA < $valueB) {
            return ($direction === 'asc') ? -1 : 1;
        } elseif ($valueA > $valueB) {
            return ($direction === 'asc') ? 1 : -1;
        }
    }
    return 0;
});







?>




