<?php
require_once('data.php');

/// Функція для отримання параметрів сортування з URL
function getSortParams() {
    $sorts = [];

    if (isset($_GET['sort'])) {
        $sortString = $_GET['sort'];
        $sortParams = explode(',', $sortString);

        foreach ($sortParams as $param) {
            list($field, $order) = explode(':', $param);
            $field = trim($field);
            $order = trim($order);

            if (!empty($field) && !empty($order)) {
                $sorts[$field] = $order;
            }
        }
    }

    return $sorts;
}

// Функція для побудови URL з параметрами сортування
function buildSortUrl($currentSorts, $column) {
    $sortUrl = '?sort=';

    foreach ($currentSorts as $field => $order) {
        if ($field !== $column) {
            $sortUrl .= $field . ':' . $order . ',';
        }
    }

    $newOrder = ($currentSorts[$column] === 'asc' || !$currentSorts[$column]) ? 'desc' : 'asc';
    $sortUrl .= $column . ':' . $newOrder;

    return rtrim($sortUrl, ',');
}
//// Функція для порівняння за кількома стовпцями
//function multiSort($a, $b, $sorts) {
//    foreach ($sorts as $col => $order) {
//        $result = strnatcasecmp($a[$col], $b[$col]); // strnatcasecmp для рядків (без урахування регістру)
//        if ($result !== 0) {
//            return ($order === 'asc') ? $result : -$result;
//        }
//    }
//    return 0;
//}
//
// Функція для отримання параметрів сортування з URL






?>




