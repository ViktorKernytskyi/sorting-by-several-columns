<?php
require_once('data.php');

// Функція для створення URL з параметрами сортування
function buildSortUrl($column) {
    $order = isset($_GET['sort'][$column]) && $_GET['sort'][$column] === 'asc' ? 'desc' : 'asc';
    return http_build_query(['sort' => [$column => $order]]);
}

require_once('functions.php');

if (!isset($arr)) {
    include('data.php');
}

// Функція для багаторівневого сортування
function multiLevelSort($a, $b) {
    global $sortColumn, $sortOrder;

    $result = strcmp($a[$sortColumn], $b[$sortColumn]) * ($sortOrder === 'asc' ? 1 : -1);

    if ($result === 0) {
        // Якщо рівні, сортуємо за іншими стовпцями (наприклад, за назвою)
        $result = strcmp($a['name'], $b['name']);
    }

    return $result;
}

?>


